import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import './style.css';

const API_BASE_URL = (import.meta.env.VITE_API_BASE_URL || '').replace(/\/+$/, '');
const APP_HOME = import.meta.env.VITE_APP_HOME || '/inventory';
const emptyProduct = { product_name: '', description: '', price: '', quantity: '' };

async function request(path, options = {}) {
  const response = await fetch(`${API_BASE_URL}${path}`, {
    credentials: 'include',
    ...options,
    headers: {
      ...(options.body ? { 'Content-Type': 'application/json' } : {}),
      ...options.headers,
    },
  });
  const result = response.status === 204 ? {} : await response.json();
  if (!response.ok) throw new Error(result.error || 'Something went wrong.');
  return result;
}

function App() {
  const [user, setUser] = useState(null);
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [search, setSearch] = useState('');
  const [editor, setEditor] = useState(null);
  const [saving, setSaving] = useState(false);

  async function loadProducts() {
    const result = await request('/api/products');
    setProducts(result.data || []);
  }

  useEffect(() => {
    request('/api/auth/me')
      .then((result) => setUser(result.data))
      .catch(() => setUser(null))
      .finally(() => setLoading(false));
  }, []);

  useEffect(() => {
    if (!user) return;
    loadProducts().catch((cause) => setError(cause.message));
  }, [user]);

  async function signIn(event) {
    event.preventDefault();
    setError('');
    setLoading(true);
    try {
      const result = await request('/api/auth/login', {
        method: 'POST',
        body: JSON.stringify({ email, password }),
      });
      setUser(result.data);
      setPassword('');
    } catch (cause) {
      setError(cause.message);
    } finally {
      setLoading(false);
    }
  }

  async function signOut() {
    await request('/api/auth/logout', { method: 'POST' }).catch(() => {});
    setUser(null);
    setProducts([]);
  }

  async function saveProduct(event) {
    event.preventDefault();
    setSaving(true);
    setError('');
    const editing = Boolean(editor.id);
    try {
      await request(editing ? `/api/products/${editor.id}` : '/api/products', {
        method: editing ? 'PUT' : 'POST',
        body: JSON.stringify(editor),
      });
      setEditor(null);
      await loadProducts();
    } catch (cause) {
      setError(cause.message);
    } finally {
      setSaving(false);
    }
  }

  async function removeProduct(product) {
    if (!window.confirm(`Delete ${product.product_name}?`)) return;
    try {
      await request(`/api/products/${product.id}`, { method: 'DELETE' });
      await loadProducts();
    } catch (cause) {
      setError(cause.message);
    }
  }

  const filtered = products.filter((product) =>
    `${product.product_name} ${product.description}`.toLowerCase().includes(search.toLowerCase()),
  );
  const units = products.reduce((total, product) => total + Number(product.quantity), 0);
  const value = products.reduce((total, product) => total + Number(product.price) * Number(product.quantity), 0);

  if (loading) return <main className="loading-screen"><span className="loader" />Loading inventory</main>;

  if (!user) {
    return (
      <main className="login-layout">
        <section className="login-art" aria-label="Stockroom inventory">
          <div className="brand brand-light"><span className="brand-mark">S</span> STOCKROOM</div>
          <div className="art-copy">
            <p className="eyebrow">PRODUCT OPERATIONS / 06</p>
            <h1>Know what<br />you have.</h1>
            <p>A clearer view of every item, every count, every day.</p>
          </div>
          <div className="art-index"><span>INVENTORY SYSTEM</span><span>01 — 06</span></div>
        </section>
        <section className="login-panel">
          <form className="login-form" onSubmit={signIn}>
            <span className="eyebrow">WELCOME BACK</span>
            <h2>Sign in to Stockroom</h2>
            <p className="muted">Use your registered LavaLust account.</p>
            {error && <p className="notice" role="alert">{error}</p>}
            <label>Email address<input type="email" autoComplete="username" value={email} onChange={(event) => setEmail(event.target.value)} required /></label>
            <label>Password<input type="password" autoComplete="current-password" value={password} onChange={(event) => setPassword(event.target.value)} required /></label>
            <button className="primary-button full-button" type="submit">Sign in <span aria-hidden="true">↗</span></button>
          </form>
          <span className="login-foot">LAVALUST API · SESSION AUTHENTICATED</span>
        </section>
      </main>
    );
  }

  return (
    <div className="app-shell">
      <aside className="sidebar">
        <a className="brand" href={APP_HOME}><span className="brand-mark">S</span> STOCKROOM</a>
        <div className="side-section-label">WORKSPACE</div>
        <a className="side-link active" href={APP_HOME}><span className="side-dot" />Products</a>
        <div className="sidebar-bottom">
          <div className="account-mark">{(user.email || 'U').slice(0, 1).toUpperCase()}</div>
          <div className="account-copy"><strong>{user.email}</strong><span>{user.role || 'Member'}</span></div>
          <button className="text-button logout-button" onClick={signOut}>Sign out</button>
        </div>
      </aside>

      <main className="workspace">
        <header className="topbar"><span>INVENTORY / PRODUCTS</span><span className="live-status"><i /> SYSTEM ONLINE</span></header>
        <section className="page-heading">
          <div><p className="eyebrow">CATALOGUE MANAGEMENT</p><h1>Products</h1><p className="muted">Keep your stock and product details in order.</p></div>
          <button className="primary-button" onClick={() => setEditor({ ...emptyProduct })}><span aria-hidden="true">＋</span> Add product</button>
        </section>

        {error && <div className="notice page-notice" role="alert">{error}<button className="notice-dismiss" onClick={() => setError('')} aria-label="Dismiss error">×</button></div>}

        <section className="metrics" aria-label="Inventory summary">
          <article className="metric"><span className="metric-label">PRODUCTS</span><strong>{products.length.toLocaleString()}</strong><span className="metric-note">active catalogue items</span></article>
          <article className="metric metric-accent"><span className="metric-label">UNITS IN STOCK</span><strong>{units.toLocaleString()}</strong><span className="metric-note">across all products</span></article>
          <article className="metric"><span className="metric-label">STOCK VALUE</span><strong>{new Intl.NumberFormat(undefined, { style: 'currency', currency: 'PHP' }).format(value)}</strong><span className="metric-note">based on current quantity</span></article>
        </section>

        <section className="catalogue">
          <div className="catalogue-head"><div><h2>Product catalogue</h2><span>{filtered.length} {filtered.length === 1 ? 'item' : 'items'}</span></div><label className="search-field"><span aria-hidden="true">⌕</span><input type="search" placeholder="Search products" value={search} onChange={(event) => setSearch(event.target.value)} /></label></div>
          <div className="table-scroll">
            <table>
              <thead><tr><th>PRODUCT</th><th>DESCRIPTION</th><th>PRICE</th><th>QUANTITY</th><th>ADDED</th><th><span className="sr-only">Actions</span></th></tr></thead>
              <tbody>
                {filtered.map((product) => (
                  <tr key={product.id}>
                    <td><strong className="product-name">{product.product_name}</strong><span className="product-id">SKU-{String(product.id).padStart(4, '0')}</span></td>
                    <td className="description-cell">{product.description || '—'}</td>
                    <td className="mono">₱{Number(product.price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td><span className={`quantity-pill ${Number(product.quantity) < 5 ? 'low-stock' : ''}`}>{Number(product.quantity)} <small>units</small></span></td>
                    <td className="date-cell">{product.created_at ? new Date(product.created_at).toLocaleDateString() : '—'}</td>
                    <td><div className="row-actions"><button className="text-button" onClick={() => setEditor({ ...product })}>Edit</button><button className="text-button danger-text" onClick={() => removeProduct(product)}>Delete</button></div></td>
                  </tr>
                ))}
                {!filtered.length && <tr><td className="empty-state" colSpan="6"><span className="empty-mark">—</span><strong>{search ? 'No matching products' : 'Your catalogue is empty'}</strong><span>{search ? 'Try another search term.' : 'Add a product to start tracking your inventory.'}</span>{!search && <button className="secondary-button" onClick={() => setEditor({ ...emptyProduct })}>Add your first product</button>}</td></tr>}
              </tbody>
            </table>
          </div>
        </section>
        <footer className="page-footer"><span>STOCKROOM / LAVALUST</span><span>PRODUCT MANAGEMENT</span></footer>
      </main>

      {editor && <div className="modal-backdrop" onMouseDown={(event) => event.target === event.currentTarget && setEditor(null)}>
        <section className="editor-panel" role="dialog" aria-modal="true" aria-labelledby="editor-title">
          <div className="editor-heading"><div><p className="eyebrow">PRODUCT DETAILS</p><h2 id="editor-title">{editor.id ? 'Edit product' : 'Add a product'}</h2></div><button className="close-button" onClick={() => setEditor(null)} aria-label="Close">×</button></div>
          <form onSubmit={saveProduct} className="product-form">
            <label>Product name<input maxLength="100" value={editor.product_name || ''} onChange={(event) => setEditor({ ...editor, product_name: event.target.value })} required autoFocus /></label>
            <label>Description<textarea rows="4" value={editor.description || ''} onChange={(event) => setEditor({ ...editor, description: event.target.value })} /></label>
            <div className="form-pair"><label>Price (PHP)<input type="number" min="0" step="0.01" value={editor.price ?? ''} onChange={(event) => setEditor({ ...editor, price: event.target.value })} required /></label><label>Quantity<input type="number" min="0" step="1" value={editor.quantity ?? ''} onChange={(event) => setEditor({ ...editor, quantity: event.target.value })} required /></label></div>
            {error && <p className="notice" role="alert">{error}</p>}
            <div className="form-actions"><button type="button" className="secondary-button" onClick={() => setEditor(null)}>Cancel</button><button className="primary-button" type="submit" disabled={saving}>{saving ? 'Saving…' : editor.id ? 'Save changes' : 'Create product'}</button></div>
          </form>
        </section>
      </div>}
    </div>
  );
}

createRoot(document.getElementById('root')).render(<App />);