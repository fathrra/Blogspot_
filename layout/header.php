<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f7;
            color: #1d1d1f;
            font-size: 15px;
            line-height: 1.6;
            padding-top: 50px;
        }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 50px;
            background: rgba(255,255,255,0.9);
            border-bottom: 1px solid #d2d2d7;
            display: flex;
            align-items: center;
            padding: 0 40px;
            z-index: 100;
        }
        nav .logo {
            font-size: 16px;
            font-weight: 600;
            color: #1d1d1f;
            text-decoration: none;
            margin-right: auto;
        }
        nav a {
            color: #6e6e73;
            font-size: 13px;
            text-decoration: none;
            padding: 5px 12px;
            border-radius: 20px;
            margin-left: 4px;
        }
        nav a:hover { background: #f5f5f7; color: #1d1d1f; }

        /* WRAPPER */
        .wrap {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 24px 80px;
        }

        /* HERO */
        .hero {
            text-align: center;
            padding: 80px 24px 60px;
            background: #fff;
            margin: -40px -24px 40px;
            border-bottom: 1px solid #d2d2d7;
        }
        .hero h1 {
            font-size: 48px;
            font-weight: 600;
            letter-spacing: -1.5px;
            margin-bottom: 14px;
            color: #1d1d1f;
        }
        .hero p {
            font-size: 17px;
            color: #6e6e73;
            font-weight: 300;
            margin-bottom: 28px;
        }

        /* PAGE TITLE */
        .page-title {
            text-align: center;
            padding: 56px 24px 40px;
            background: #fff;
            margin: -40px -24px 40px;
            border-bottom: 1px solid #d2d2d7;
        }
        .page-title small {
            display: block;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #aeaeb2;
            margin-bottom: 10px;
        }
        .page-title h1 {
            font-size: 36px;
            font-weight: 600;
            letter-spacing: -1px;
            color: #1d1d1f;
        }

        /* BUTTONS */
        .btn {
            display: inline-block;
            background: #0071e3;
            color: #fff;
            font-size: 14px;
            padding: 10px 22px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
        }
        .btn:hover { background: #0077ed; color: #fff; }
        .btn-gray {
            background: #e8e8ed;
            color: #1d1d1f;
        }
        .btn-gray:hover { background: #ddd; color: #1d1d1f; }
        .btn-sm {
            font-size: 12px;
            padding: 5px 13px;
        }
        .btn-red {
            background: #fff0f0;
            color: #ff3b30;
            border: 1px solid #ffcdc9;
        }
        .btn-red:hover { background: #ffe0e0; color: #ff3b30; }

        /* CARD (blog post card) */
        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.2s;
        }
        .card:hover { transform: translateY(-3px); color: inherit; }
        .card-img {
            height: 130px;
            background: #1d1d1f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: rgba(255,255,255,0.08);
            font-weight: 600;
        }
        .card-body { padding: 18px; }
        .card-body h3 { font-size: 14px; font-weight: 500; margin-bottom: 6px; }
        .card-body p  { font-size: 12px; color: #6e6e73; }
        .card-foot {
            padding: 12px 18px;
            border-top: 1px solid #f0f0f0;
            font-size: 12px;
            color: #0071e3;
        }

        /* BADGE */
        .badge {
            display: inline-block;
            background: #f0f0f5;
            color: #6e6e73;
            font-size: 10px;
            font-weight: 500;
            padding: 2px 9px;
            border-radius: 20px;
            margin-bottom: 6px;
            letter-spacing: 0.03em;
        }

        /* TABLE */
        .table-wrap {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e0e0e5;
        }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            padding: 11px 18px;
            text-align: left;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: #aeaeb2;
            background: #f5f5f7;
            border-bottom: 1px solid #e0e0e5;
        }
        tbody tr { border-bottom: 1px solid #f0f0f0; transition: background 0.1s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fafafa; }
        tbody td { padding: 12px 18px; vertical-align: middle; }

        /* FORM */
        .form-wrap {
            background: #fff;
            border-radius: 16px;
            padding: 24px 28px;
            border: 1px solid #e0e0e5;
        }
        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #6e6e73;
            margin-bottom: 6px;
        }
        input[type=text], select, textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1px solid #d2d2d7;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            background: #f5f5f7;
            color: #1d1d1f;
            outline: none;
            display: block;
        }
        input[type=text]:focus,
        select:focus,
        textarea:focus { border-color: #0071e3; background: #fff; }
        textarea { resize: vertical; min-height: 180px; line-height: 1.6; }

        /* FOOTER */
        footer {
            background: #f5f5f7;
            border-top: 1px solid #d2d2d7;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #aeaeb2;
            margin-top: 60px;
        }

        /* ARTICLE */
        .article {
            background: #fff;
            border-radius: 16px;
            padding: 36px 40px;
            border: 1px solid #e0e0e5;
            font-size: 16px;
            line-height: 1.8;
            color: #3d3d3f;
            font-weight: 300;
            max-width: 660px;
            margin: 0 auto;
        }
        .article p { margin-bottom: 1em; }
        .article p:last-child { margin: 0; }

        /* UTILITY */
        .mb-3 { margin-bottom: 16px; }
        .mb-4 { margin-bottom: 24px; }
        .mt-3 { margin-top: 16px; }
        .mt-4 { margin-top: 24px; }
        .d-flex { display: flex; }
        .justify-between { justify-content: space-between; }
        .align-center { align-items: center; }
        .text-muted { color: #aeaeb2; font-size: 12px; }
        .row { display: flex; flex-wrap: wrap; gap: 16px; }
        .col-4 { flex: 0 0 calc(33.33% - 11px); }
        .col-8 { flex: 0 0 calc(66.66% - 6px); }
        .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; }
    </style>
</head>
<body>

<nav>
    <a class="logo" href="/index.php">My Blog</a>
    <a href="/blogspot_/Blogspot_/index.php">Home</a>
    <a href="/blogspot_/Blogspot_/posts.php">Posts</a>
    <a href="/blogspot_/Blogspot_/categories/index.php">Categories</a>
</nav>

<div class="wrap">