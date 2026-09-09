<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            width: min(100%, 480px);
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
            gap: 16px;
            padding: 28px 30px;
            color: var(--white);
            background: linear-gradient(135deg, var(--pink), #f28bb1);
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

        h1 {
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

        .error-message {
            margin-bottom: 20px;
            padding: 12px 16px;
            border: 1px solid var(--pink-line);
            border-radius: 12px;
            color: var(--error-text);
            background-color: var(--error-bg);
            font: 14px Arial, sans-serif;
            text-align: center;
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

        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--pink-line);
            border-radius: 12px;
            color: var(--ink);
            background-color: var(--pink-soft);
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: var(--pink);
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(232, 93, 145, 0.2);
        }

        button[type="submit"] {
            margin-top: 10px;
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
        }
    </style>
</head>
<body>

<div class="container">

    <!-- NAVIGATION -->
    <nav class="navbar">
        <a href="<?= site_url('') ?>">Home</a>
        <a href="<?= site_url('login') ?>" class="active">Login</a>
    </nav>

    <!-- HEADER -->
    <header class="header">
        <div class="header-icon" aria-hidden="true">&#9829;</div>
        <div>
            <h1>Login</h1>
            <p class="subtitle">Welcome back! Please enter your details</p>
        </div>
    </header>

    <!-- FORM SECTION -->
    <div class="form-wrap">

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('/login'); ?>" method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="enter@email.com">
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <div>
                <label for="role">Login as:</label>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit">Login</button>
        </form>

    </div>

</div>

</body>
</html>