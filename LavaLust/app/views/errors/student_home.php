<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <style>
        :root {
            --pink: #e85d91;
            --pink-dark: #b83268;
            --pink-light: #fff1f6;
            --ink: #4b2435;
            --muted: #8b6171;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 32px 18px;
            background: #ffe3ee;
            background-image: radial-gradient(#f6a9c5 1px, transparent 1px);
            background-size: 22px 22px;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
        }

        .page {
            width: min(100%, 760px);
            margin: 0 auto;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        nav a {
            padding: 10px 18px;
            border: 2px solid var(--pink);
            border-radius: 999px;
            background: var(--white);
            color: var(--pink-dark);
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        nav a:hover,
        nav a:focus-visible {
            background: var(--pink);
            color: var(--white);
            transform: translateY(-2px);
        }

        .welcome-card {
            overflow: hidden;
            border: 3px solid #f7b2ca;
            border-radius: 28px;
            background: var(--white);
            box-shadow: 0 18px 45px rgba(146, 52, 91, 0.18);
            text-align: center;
        }

        .welcome-header {
            padding: 42px 24px 36px;
            background: var(--pink);
            color: var(--white);
        }

        .heart {
            display: grid;
            width: 78px;
            height: 78px;
            margin: 0 auto 16px;
            place-items: center;
            border: 4px solid var(--white);
            border-radius: 50%;
            background: var(--pink-light);
            color: var(--pink-dark);
            font-size: 34px;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 6vw, 42px);
        }

        .message {
            padding: 34px 24px 40px;
        }

        .message p {
            margin: 0;
            color: var(--muted);
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        @media (max-width: 560px) {
            body {
                padding: 20px 12px;
            }

            nav {
                gap: 8px;
            }

            nav a {
                flex: 1;
                padding: 10px 8px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <nav aria-label="Student navigation">
            <a href="<?= site_url('student') ?>">Student Home</a>
            <a href="<?= site_url('student/profile') ?>">Profile</a>
        </nav>

        <section class="welcome-card">
            <header class="welcome-header">
                <div class="heart" aria-hidden="true">&#9829;</div>
                <h1>HELLO EVERYONE!</h1>
            </header>

            <div class="message">
                <p>Welcome to the student home page.</p>
            </div>
        </section>
    </main>
</body>
</html>