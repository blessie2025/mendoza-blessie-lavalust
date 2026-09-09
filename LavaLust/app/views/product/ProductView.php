<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <style>
        :root {
            --pink: #e85d91;
            --pink-dark: #a93668;
            --pink-soft: #fff1f6;
            --pink-line: #f5c4d7;
            --ink: #482638;
            --muted: #8c6677;
            --white: #ffffff;
            --danger: #d93868;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 18px;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            background-color: #ffe5ef;
            background-image: radial-gradient(#f2a8c3 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .container {
            width: min(100%, 980px);
            margin: auto;
            overflow: hidden;
            border: 2px solid var(--pink-line);
            border-radius: 24px;
            background: var(--white);
            box-shadow: 0 20px 50px rgba(132, 42, 79, 0.16);
        }

        /* NAVIGATION BAR */
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 15px 20px;
            background: #ffffff;
            border-bottom: 1px solid var(--pink-line);
            flex-wrap: wrap;
        }

        .navbar a {
            padding: 10px 20px;
            border-radius: 20px;
            color: var(--pink-dark);
            text-decoration: none;
            font: 600 14px Arial, sans-serif;
            transition: 0.2s ease;
        }

        .navbar a:hover {
            background: var(--pink-soft);
        }

        .navbar a.active {
            color: white;
            background: var(--pink);
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 28px 30px;
            color: var(--white);
            background: linear-gradient(135deg, var(--pink), #f28bb1);
            flex-wrap: wrap;
        }

        .header-main {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            display: grid;
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            place-items: center;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            font-size: 24px;
        }

        h2 {
            margin: 0;
            font-size: clamp(24px, 4vw, 34px);
            font-weight: normal;
        }

        .subtitle {
            margin: 5px 0 0;
            color: #fff5f9;
            font: 14px Arial, sans-serif;
        }

        /* HEADER BUTTONS */
        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            display: inline-block;
            padding: 10px 18px;
            border: 2px solid var(--white);
            border-radius: 20px;
            color: var(--pink-dark);
            background: var(--white);
            text-decoration: none;
            font: 600 13px Arial, sans-serif;
            transition: 0.2s ease;
        }

        .btn-action:hover {
            background: var(--pink-soft);
            color: var(--pink-dark);
        }

        /* NOTIFICATION TOAST */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 280px;
            padding: 14px 18px;
            border: 1px solid var(--pink-line);
            border-radius: 12px;
            color: var(--pink-dark);
            background: var(--pink-soft);
            box-shadow: 0 8px 24px rgba(132, 42, 79, 0.18);
            font: 600 14px Arial, sans-serif;
        }

        .notification button {
            float: right;
            margin-left: 16px;
            color: var(--pink-dark);
            background: transparent;
            border: 0;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
        }

        /* TABLE */
        .table-wrap {
            padding: 18px 24px 24px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
            font: 14px Arial, sans-serif;
        }

        th,
        td {
            padding: 15px 14px;
            text-align: left;
            border-bottom: 1px solid var(--pink-line);
        }

        th {
            color: var(--pink-dark);
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: var(--pink-soft);
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #fff7fa;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        td:first-child {
            color: var(--pink-dark);
            font-weight: 700;
        }

        /* ACTION LINKS */
        .action-link {
            display: inline-block;
            margin-right: 8px;
            padding: 6px 12px;
            border-radius: 14px;
            color: var(--pink-dark);
            background: var(--pink-soft);
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .action-link:hover {
            color: var(--white);
            background: var(--pink);
        }

        .action-link.delete:hover {
            background: var(--danger);
        }

        .empty {
            padding: 30px;
            color: var(--muted);
            text-align: center;
        }

        /* MOBILE */
        @media (max-width: 600px) {
            body {
                padding: 24px 12px;
            }

            .navbar {
                gap: 5px;
                padding: 12px 10px;
            }

            .navbar a {
                padding: 8px 13px;
                font-size: 13px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                padding: 22px 20px;
            }

            .header-actions {
                width: 100%;
            }

            .btn-action {
                flex: 1;
                text-align: center;
            }

            .table-wrap {
                padding: 12px 14px 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- NAVIGATION -->
    <nav class="navbar">
        <a href="<?= site_url('') ?>">Home</a>
        <a href="<?= site_url('products') ?>" class="active">Products</a>
    </nav>

    <!-- NOTIFICATION TOAST -->
    <?php if (!empty($notification)): ?>
        <div class="notification" role="status" id="notification">
            <button type="button" onclick="document.getElementById('notification').remove();" aria-label="Close notification">&times;</button>
            <?= htmlspecialchars($notification, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- HEADER -->
    <header class="header">
        <div class="header-main">
            <div class="header-icon" aria-hidden="true">&#9829;</div>
            <div>
                <h2>Product Catalog</h2>
                <p class="subtitle">
                    Logged in as: <strong><?= htmlspecialchars($name ?? 'User', ENT_QUOTES, 'UTF-8'); ?></strong>
                </p>
            </div>
        </div>

        <div class="header-actions">
            <?php if ($user_role === 'admin'): ?>
                <a href="<?= site_url('/product/create'); ?>" class="btn-action">+ Add Product</a>
            <?php endif; ?>
            <a href="<?= site_url('/logout'); ?>" class="btn-action">Logout</a>
        </div>
    </header>

    <!-- TABLE -->
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <?php if ($user_role === 'admin'): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($product['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if ($user_role === 'admin'): ?>
                                <td>
                                    <a href="<?= site_url('/product/edit/' . $product['id']); ?>" class="action-link">Edit</a>
                                    <a href="<?= site_url('/product/delete/' . $product['id']); ?>" onclick="return confirm('Delete this product?');" class="action-link delete">Delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= $user_role === 'admin' ? '6' : '5'; ?>" class="empty">
                            No products found in the catalog.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php if (!empty($notification)): ?>
    <script>
        window.setTimeout(function () {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.remove();
            }
        }, 4000);
    </script>
<?php endif; ?>

</body>
</html>