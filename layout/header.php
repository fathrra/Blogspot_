<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #18181B;
            --ink-soft:  #3f3f46;
            --cream:     #FAF9F6;
            --cream-2:   #F3F1EC;
            --white:     #ffffff;
            --border:    rgba(0,0,0,0.08);
            --border-2:  rgba(0,0,0,0.14);
            --muted:     #71717A;
            --muted-2:   #A1A1AA;
            --badge-bg:  #EEF3FB;
            --badge-col: #1D5FA6;
            --edit-bg:   #FEFCE8;
            --edit-bdr:  #D4A435;
            --edit-col:  #78530A;
            --del-bg:    #FFF1F1;
            --del-bdr:   #E05252;
            --del-col:   #991B1B;
            --nav-h:     54px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            font-size: 14.5px;
            line-height: 1.75;
            padding-top: var(--nav-h);
        }

        /* NAVBAR */
        .site-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            height: var(--nav-h);
            background: var(--ink);
            display: flex; align-items: center;
            padding: 0 2.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .site-nav .brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 600;
            color: #fff; text-decoration: none;
            letter-spacing: -0.3px; margin-right: auto;
            display: flex; align-items: center; gap: 8px;
        }
        .site-nav .brand::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: inline-block;
        }
        .site-nav .nav-links { display: flex; gap: 2px; }
        .site-nav .nav-links a {
            color: rgba(255,255,255,0.48);
            font-size: 12.5px; font-weight: 400;
            text-decoration: none; padding: 6px 13px;
            border-radius: 6px; letter-spacing: 0.015em;
            transition: color 0.18s, background 0.18s;
        }
        .site-nav .nav-links a:hover,
        .site-nav .nav-links a.active { color: #fff; background: rgba(255,255,255,0.1); }

        /* PAGE HERO */
        .page-hero {
            background: var(--ink);
            padding: 3.2rem 2.5rem 3.6rem;
            margin-bottom: 2.8rem;
            position: relative; overflow: hidden;
        }
        .page-hero::after {
            content: attr(data-label);
            position: absolute; right: 1.5rem; bottom: -1.2rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: 9rem; font-weight: 600;
            color: rgba(255,255,255,0.035);
            line-height: 1; pointer-events: none; user-select: none;
        }
        .hero-tag {
            display: inline-block;
            background: rgba(255,255,255,0.09);
            color: rgba(255,255,255,0.45);
            font-size: 10px; letter-spacing: 0.13em;
            text-transform: uppercase;
            padding: 4px 11px; border-radius: 20px;
            margin-bottom: 1rem; font-weight: 400;
        }
        .page-hero h1 {
            font-family: 'Cormorant Garamond', serif;
            color: #fff; font-size: 2.5rem; font-weight: 600;
            line-height: 1.15; letter-spacing: -0.5px; margin-bottom: 0.55rem;
        }
        .page-hero p { color: rgba(255,255,255,0.42); font-size: 13.5px; margin: 0; font-weight: 300; }

        /* CONTAINER */
        .main-container { max-width: 980px; margin: 0 auto; padding: 0 2.5rem 5rem; }

        /* SECTION LABEL */
        .section-label {
            font-size: 10px; letter-spacing: 0.13em;
            text-transform: uppercase; color: var(--muted-2);
            font-weight: 500; margin-bottom: 0.9rem;
        }

        /* BLOG CARDS */
        .blog-card {
            background: var(--white); border: 0.5px solid var(--border);
            border-radius: 14px; overflow: hidden; height: 100%;
            display: flex; flex-direction: column;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        }
        .blog-card:hover { transform: translateY(-4px); border-color: var(--border-2); box-shadow: 0 12px 32px rgba(0,0,0,0.07); }
        .blog-card .card-thumb {
            height: 128px; background: var(--ink);
            display: flex; align-items: center; justify-content: center;
        }
        .blog-card .card-thumb span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 42px; color: rgba(255,255,255,0.09); font-weight: 600;
        }
        .blog-card .card-inner { padding: 1.1rem 1.25rem; flex: 1; }
        .blog-card .card-footer-strip {
            padding: 0.65rem 1.25rem; border-top: 0.5px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .read-link { color: var(--badge-col); font-size: 12px; font-weight: 500; text-decoration: none; transition: opacity 0.15s; }
        .read-link:hover { opacity: 0.7; }

        /* BADGE */
        .cat-badge {
            display: inline-block; background: var(--badge-bg); color: var(--badge-col);
            font-size: 9.5px; font-weight: 500; padding: 2px 9px;
            border-radius: 20px; letter-spacing: 0.04em; margin-bottom: 7px;
        }

        /* DATA TABLE */
        .data-table-wrap { background: var(--white); border: 0.5px solid var(--border); border-radius: 14px; overflow: hidden; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        .data-table thead th {
            padding: 11px 20px; text-align: left;
            font-size: 9.5px; font-weight: 500; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--muted-2);
            background: var(--cream-2); border-bottom: 0.5px solid var(--border);
        }
        .data-table tbody tr { border-bottom: 0.5px solid rgba(0,0,0,0.045); transition: background 0.12s; }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #FAFAF8; }
        .data-table td { padding: 12px 20px; vertical-align: middle; }

        /* ACTION BUTTONS */
        .btn-edit, .btn-del {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11.5px; font-weight: 400; padding: 4px 12px;
            border-radius: 6px; text-decoration: none; border: 0.5px solid;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: opacity 0.15s; margin-right: 4px;
        }
        .btn-edit { background: var(--edit-bg); border-color: var(--edit-bdr); color: var(--edit-col); }
        .btn-del  { background: var(--del-bg);  border-color: var(--del-bdr);  color: var(--del-col);  }
        .btn-edit:hover, .btn-del:hover { opacity: 0.7; }

        /* PRIMARY / OUTLINE */
        .btn-dark {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--ink); color: #fff;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            padding: 9px 20px; border-radius: 8px; border: none;
            cursor: pointer; text-decoration: none; transition: opacity 0.15s;
        }
        .btn-dark:hover { opacity: 0.78; color: #fff; }
        .btn-dark-outline {
            display: inline-flex; align-items: center; gap: 6px;
            background: transparent; color: var(--ink-soft);
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 400;
            padding: 9px 20px; border-radius: 8px;
            border: 0.5px solid rgba(0,0,0,0.22);
            cursor: pointer; text-decoration: none; transition: background 0.15s, color 0.15s;
        }
        .btn-dark-outline:hover { background: rgba(0,0,0,0.045); color: var(--ink); }

        /* FORM CARD */
        .form-card { background: var(--white); border: 0.5px solid var(--border); border-radius: 14px; padding: 1.6rem 1.8rem; }
        .form-card .form-label {
            font-size: 11.5px; font-weight: 500; color: var(--muted);
            margin-bottom: 6px; letter-spacing: 0.02em; display: block;
        }
        .form-card .form-control,
        .form-card .form-select {
            font-family: 'DM Sans', sans-serif; font-size: 13.5px;
            border: 0.5px solid rgba(0,0,0,0.18); border-radius: 8px;
            background: var(--cream); color: var(--ink);
            padding: 9px 13px; width: 100%;
            transition: border-color 0.15s, background 0.15s;
            appearance: none; -webkit-appearance: none; display: block;
        }
        .form-card .form-control:focus,
        .form-card .form-select:focus { border-color: var(--ink); background: var(--white); box-shadow: none; outline: none; }
        .form-card textarea.form-control { resize: vertical; min-height: 190px; line-height: 1.65; }
        .btn-submit {
            background: var(--ink); color: #fff;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            padding: 10px 26px; border: none; border-radius: 8px;
            cursor: pointer; transition: opacity 0.15s;
        }
        .btn-submit:hover { opacity: 0.78; }

        /* ARTICLE */
        .article-body {
            background: var(--white); border: 0.5px solid var(--border);
            border-radius: 14px; padding: 2.4rem 2.8rem;
            font-size: 15.5px; line-height: 1.9;
            color: var(--ink-soft); font-weight: 300;
            max-width: 680px; margin: 0 auto;
        }
        .article-body p { margin-bottom: 1.1em; }
        .article-body p:last-child { margin-bottom: 0; }

        /* FOOTER */
        .site-footer {
            background: var(--ink); color: rgba(255,255,255,0.28);
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.3rem 2.5rem; font-size: 12px;
            letter-spacing: 0.03em; margin-top: 5rem;
        }
        .site-footer .f-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600; color: rgba(255,255,255,0.22);
        }

        /* EMPTY */
        .empty-row td { text-align: center; padding: 2.5rem !important; color: var(--muted-2); font-size: 13px; }
        .empty-row td a { color: var(--badge-col); text-decoration: none; }
    </style>
</head>
<body>

<nav class="site-nav">
    <a class="brand" href="/index.php">My Blog</a>
    <div class="nav-links">
        <a href="/blogspot_/Blogspot_/index.php">Home</a>
        <a href="/blogspot_/Blogspot_/posts.php">Posts</a>
        <a href="/blogspot_/Blogspot_/categories/index.php">Categories</a>
    </div>
</nav>

<div class="main-container">