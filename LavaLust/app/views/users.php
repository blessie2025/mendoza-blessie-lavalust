```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>

    <style>
        :root {
            --pink: #e85d91;
            --pink-dark: #a93668;
            --pink-soft: #fff1f6;
            --pink-line: #f5c4d7;
            --ink: #482638;
            --muted: #8c6677;
            --white: #ffffff;
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

        h2 {
            margin: 0;
            font-size: clamp(24px, 4vw, 34px);
        }

        .subtitle {
            margin: 5px 0 0;
            color: #fff5f9;
            font: 14px Arial, sans-serif;
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
                padding: 22px 20px;
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
        <a href="index.php">Home</a>
        <a href="show-users.php" class="active">Registered Users</a>
        <a href="profile.php">Profile</a>
    </nav>

    <!-- HEADER -->
    <header class="header">
        <div class="header-icon" aria-hidden="true">&#9829;</div>

        <div>
            <h2>Registered Users</h2>
            <p class="subtitle">
                A lovely little directory of account records
            </p>
        </div>
    </header>

    <!-- USERS TABLE -->
    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($users)): ?>

                    <?php foreach ($users as $user): ?>

                        <tr>
                            <td>
                                <?= html_escape($user['id'] ?? ''); ?>
                            </td>

                            <td>
                                <?= html_escape($user['firstname'] ?? ''); ?>
                            </td>

                            <td>
                                <?= html_escape($user['lastname'] ?? ''); ?>
                            </td>

                            <td>
                                <?= html_escape($user['email'] ?? ''); ?>
                            </td>

                            <td>
                                <?= html_escape($user['username'] ?? ''); ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="empty">
                            No users found in the database.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
```
