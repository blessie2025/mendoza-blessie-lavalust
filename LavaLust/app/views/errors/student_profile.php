<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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

        .profile-card {
            overflow: hidden;
            border: 3px solid #f7b2ca;
            border-radius: 28px;
            background: var(--white);
            box-shadow: 0 18px 45px rgba(146, 52, 91, 0.18);
        }

        .card-header {
            padding: 34px 32px 28px;
            background: var(--pink);
            color: var(--white);
            text-align: center;
        }

        .avatar {
            display: grid;
            width: 76px;
            height: 76px;
            margin: 0 auto 14px;
            place-items: center;
            border: 4px solid var(--white);
            border-radius: 50%;
            background: var(--pink-light);
            color: var(--pink-dark);
            font-size: 32px;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 6vw, 42px);
        }

        .subtitle {
            margin: 8px 0 0;
            color: #fff5f8;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            padding: 28px 32px 34px;
        }

        .detail {
            padding: 16px;
            border: 1px solid #f7c9d9;
            border-radius: 14px;
            background: var(--pink-light);
        }

        .label {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-family: Arial, sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .value {
            display: block;
            overflow-wrap: anywhere;
            color: var(--ink);
            font-size: 17px;
            font-weight: 700;
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

            .card-header,
            .details {
                padding-left: 20px;
                padding-right: 20px;
            }

            .details {
                grid-template-columns: 1fr;
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

        <section class="profile-card">
            <header class="card-header">
                <div class="avatar" aria-hidden="true">&#9829;</div>
                <h1>Student Profile</h1>
                <p class="subtitle">A little place for your student details</p>
            </header>

            <div class="details">
                <div class="detail">
                    <span class="label">Student ID</span>
                    <span class="value"><?= $student_id ?></span>
                </div>
                <div class="detail">
                    <span class="label">Name</span>
                    <span class="value"><?= $name ?></span>
                </div>
                <div class="detail">
                    <span class="label">Course</span>
                    <span class="value"><?= $course ?></span>
                </div>
                <div class="detail">
                    <span class="label">Year Level</span>
                    <span class="value"><?= $year_level ?></span>
                </div>
                <div class="detail">
                    <span class="label">Section</span>
                    <span class="value"><?= $section ?></span>
                </div>
                <div class="detail">
                    <span class="label">Email</span>
                    <span class="value"><?= $email ?></span>
                </div>
            </div>
        </section>
    </main>
</body>
</html>