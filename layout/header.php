<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --dark: #0f1117;
            --dark-2: #1a1d27;
            --accent: #ffffff;
            --muted: rgba(255,255,255,0.5);
            --border: rgba(255,255,255,0.07);
            --body-bg: #f7f6f3;
            --card-bg: #ffffff;
            --card-border: rgba(0,0,0,0.07);
            --text: #1a1a1a;
            --text-muted: #6b6b6b;
            --badge-bg: #eef3fb;
            --badge-color: #185FA5;
            --btn-edit-bg: #fffbf0;
            --btn-edit-border: #d4a847;
            --btn-edit-color: #7a5a0a;
            --btn-del-bg: #fff5f5;
            --btn-del-border: #d9534f;
            --btn-del-color: #a02020;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--body-bg);
            color: var(--text);
            padding-top: 56px;
            font-size: 15px;
            line-height: 1.7;
        }

        /* ── NAVBAR ── */
        .site-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: var(--dark);
            height: 56px;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid var(--border);
        }
        .site-nav .brand {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 19px;
            text-decoration: none;
            letter-spacing: -0.3px;
            margin-right: auto;
        }
        .site-nav .brand span { color: rgba(255,255,255,0.35); }
        .site-nav .nav-links { display: flex; gap: 0.25rem; }
        .site-nav .nav-links a {
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            font-weight: 400;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 6px;
            letter-spacing: 0.01em;
            transition: color 0.2s, background 0.2s;
        }
        .site-nav .nav-links a:hover,
        .site-nav .nav-links a.active {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }

        /* ── PAGE HERO ── */
        .page-hero {
            background: var(--dark);
            padding: 3rem 2rem 3.5rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 2.5rem;
        }
        .page-hero .hero-tag {
            display: inline-block;
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.45);
            font-size: 10px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 1rem;
        }
        .page-hero h1 {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.6rem;
        }
        .page-hero p {
            color: rgba(255,255,255,0.45);
            font-size: 14px;
            margin: 0;
        }

        /* ── CONTAINER ── */
        .main-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }

        /* ── SECTION LABEL ── */
        .section-label {
            font-size: 10px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        /* ── CARDS (home blog cards) ── */
        .blog-card {
            background: var(--card-bg);
            border: 0.5px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.18s, border-color 0.18s, box-shadow 0.18s;
            height: 100%;
        }
        .blog-card:hover {
            transform: translateY(-3px);
            border-color: rgba(0,0,0,0.14);
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }
        .blog-card .card-thumb {
            height: 130px;
            background: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .blog-card .card-thumb span {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            color: rgba(255,255,255,0.1);
        }
        .blog-card .card-inner { padding: 1.1rem 1.2rem; }
        .blog-card .card-footer-strip {
            padding: 0.6rem 1.2rem;
            border-top: 0.5px solid var(--card-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .read-link { color: var(--badge-color); font-size: 12px; font-weight: 500; text-decoration: none; }

        /* ── BADGE ── */
        .cat-badge {
            display: inline-block;
            background: var(--badge-bg);
            color: var(--badge-color);
            font-size: 10px;
            font-weight: 500;
            padding: 2px 9px;
            border-radius: 20px;
            letter-spacing: 0.03em;
            margin-bottom: 8px;
        }

        /* ── TABLE ── */
        .data-table-wrap {
            background: var(--card-bg);
            border: 0.5px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }
        .data-table thead th {
            padding: 10px 18px;
            text-align: left;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            background: #f9f8f6;
            border-bottom: 0.5px solid var(--card-border);
        }
        .data-table tbody tr {
            border-bottom: 0.5px solid rgba(0,0,0,0.05);
            transition: background 0.12s;
        }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #fafaf9; }
        .data-table td { padding: 11px 18px; vertical-align: middle; }

        /* ── ACTION BUTTONS ── */
        .btn-edit, .btn-del {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 400;
            padding: 4px 12px;
            border-radius: 6px;
            text-decoration: none;
            border: 0.5px solid;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: opacity 0.15s;
            margin-right: 4px;
        }
        .btn-edit {
            background: var(--btn-edit-bg);
            border-color: var(--btn-edit-border);
            color: var(--btn-edit-color);
        }
        .btn-del {
            background: var(--btn-del-bg);
            border-color: var(--btn-del-border);
            color: var(--btn-del-color);
        }
        .btn-edit:hover, .btn-del:hover { opacity: 0.75; }

        /* ── PRIMARY BUTTON ── */
        .btn-dark {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--dark);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s;
        }
        .btn-dark:hover { opacity: 0.8; color: #fff; }
        .btn-dark-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--dark);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 7px;
            border: 0.5px solid rgba(0,0,0,0.25);
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-dark-outline:hover { background: rgba(0,0,0,0.04); color: var(--dark); }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--card-bg);
            border: 0.5px solid var(--card-border);
            border-radius: 12px;
            padding: 1.5rem 1.6rem;
        }
        .form-card .card-header-label {
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 1.2rem;
        }
        .form-card .form-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }
        .form-card .form-control,
        .form-card .form-select {
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            border: 0.5px solid rgba(0,0,0,0.2);
            border-radius: 7px;
            background: #f9f8f6;
            color: var(--text);
            padding: 8px 13px;
            transition: border-color 0.15s;
        }
        .form-card .form-control:focus,
        .form-card .form-select:focus {
            border-color: var(--dark);
            box-shadow: none;
            background: #fff;
        }
        .form-card textarea.form-control { resize: vertical; min-height: 160px; }
        .btn-submit {
            background: var(--dark);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 10px 24px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            transition: opacity 0.15s;
        }
        .btn-submit:hover { opacity: 0.8; }

        /* ── FOOTER ── */
        .site-footer {
            background: var(--dark);
            color: rgba(255,255,255,0.3);
            text-align: center;
            padding: 1.6rem;
            font-size: 12px;
            letter-spacing: 0.03em;
            margin-top: 5rem;
        }
        .site-footer span { color: rgba(255,255,255,0.12); }
    </style>
</head>
<body>

<nav class="site-nav">
    <a class="brand" href="/index.php">✦ <span>My</span> Blog</a>
    <div class="nav-links">
        <a href="/index.php">Home</a>
        <a href="/posts.php">Posts</a>
        <a href="/categories/index.php">Categories</a>
    </div>
</nav>

<div class="main-container">