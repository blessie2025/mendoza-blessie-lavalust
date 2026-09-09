<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <style>
        :root {
            --pink: #e85d91;
            --pink-dark: #a93668;
            --pink-soft: #fff1f6;
            --pink-line: #f5c4d7;
            --ink: #482638;
            --muted: #8c6677;
            --white: #ffffff;
            --error-bg: #ffe0e9;
            --error-text: #b0003a;
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
            width: min(100%, 560px);
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

        /* FORM */
        .form-wrap {
            padding: 30px 30px 36px;
        }

        .error-box {
            margin-bottom: 24px;
            padding: 14px 18px;
            border: 1px solid var(--pink-line);
            border-radius: 12px;
            color: var(--error-text);
            background-color: var(--error-bg);
            font: 14px Arial, sans-serif;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-box li {
            margin-bottom: 4px;
        }

        .error-box li:last-child {
            margin-bottom: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
            font-family: Arial, sans-serif;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: var(--pink-dark);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--pink-line);
            border-radius: 12px;
            color: var(--ink);
            background-color: var(--pink-soft);
            font: 14px Arial, sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: var(--pink);
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(232, 93, 145, 0.2);
        }

        .button-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        button[type="submit"] {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 20px;
            color: var(--white);
            background: var(--pink);
            font: 700 15px Arial, sans-serif;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        button[type="submit"]:hover {
            background: var(--pink-dark);
        }

        button[type="submit"]:active {
            transform: scale(0.98);
        }

        .btn-cancel {
            display: inline-block;
            padding: 12px 20px;
            border: 1px solid var(--pink-line);
            border-radius: 20px;
            color: var(--pink-dark);
            background: var(--pink-soft);
            text-decoration: none;
            font: 600 14px Arial, sans-serif;
            text-align: center;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: var(--pink-line);
            color: var(--ink);
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
                padding: 22px 20px;
            }

            .form-wrap {
                padding: 20px 20px 24px;
            }

            .button-group {
                flex-direction: column;
            }

            button[type="submit"],
            .btn-cancel {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- NAVIGATION -->
    <nav class="navbar">
        <a href="<?= site_url('') ?>">Home</a>
        <a href="<?= site_url('/product/display') ?>" class="active">Products</a>
    </nav>

    <!-- HEADER -->
    <header class="header">
        <div class="header-main">
            <div class="header-icon" aria-hidden="true">&#9829;</div>
            <div>
                <h2>Edit Product</h2>
                <p class="subtitle">Update product information below</p>
            </div>
        </div>
    </header>

    <!-- FORM SECTION -->
    <div class="form-wrap">

        <!-- VALIDATION ERRORS -->
        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- EDIT FORM -->
        <form action="<?= site_url('/product/edit/' . $product['id']); ?>" method="post">
            <div>
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="button-group">
                <button type="submit">Update Product</button>
                <a href="<?= site_url('/product/display'); ?>" class="btn-cancel">Back to products</a>
            </div>
        </form>

    </div>

</div>

</body>
</html>