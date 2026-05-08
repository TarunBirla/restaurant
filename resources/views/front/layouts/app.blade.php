<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodRush — Premium Food Delivery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #E8370E;
            --primary-dark: #C42D0A;
            --black: #0D0D0D;
            --gray-mid: #6B7280;
            --gray-light: #F5F5F0;
            --success: #16A34A;
            --success-light: #DCFCE7;
        }
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: var(--gray-light); color: var(--black); margin: 0; }
        h1,h2,h3,h4,.font-display { font-family: 'Syne', sans-serif; }
        .btn-primary { background: var(--primary); color:#fff; font-family:'Syne',sans-serif; font-weight:700; border-radius:12px; transition:all .2s; display:inline-block; }
        .btn-primary:hover { background:var(--primary-dark); transform:translateY(-1px); box-shadow:0 6px 20px rgba(232,55,14,.35); }
        .btn-black { background:var(--black); color:#fff; font-family:'Syne',sans-serif; font-weight:700; border-radius:12px; transition:all .2s; display:inline-block; }
        .btn-black:hover { background:#333; transform:translateY(-1px); }
        .card { background:#fff; border-radius:20px; box-shadow:0 2px 16px rgba(0,0,0,.07); }
        .badge-primary { background:var(--primary); color:#fff; border-radius:999px; font-size:12px; font-weight:700; padding:3px 12px; font-family:'Syne',sans-serif; }
        .badge-success { background:var(--success-light); color:var(--success); border-radius:999px; font-size:13px; font-weight:600; padding:4px 14px; }
        .sidebar-link { display:block; padding:13px 18px; border-radius:12px; font-weight:500; transition:all .18s; color:var(--black); }
        .sidebar-link:hover { background:var(--gray-light); }
        .sidebar-link.active { background:var(--primary); color:#fff; font-weight:700; }
        input,select,textarea { border:1.5px solid #E5E5E0; border-radius:12px; padding:13px 16px; font-family:'DM Sans',sans-serif; font-size:15px; width:100%; outline:none; transition:border .18s; background:#FAFAF8; }
        input:focus,select:focus,textarea:focus { border-color:var(--primary); }
        label { font-weight:600; font-size:14px; display:block; margin-bottom:7px; font-family:'Syne',sans-serif; }
        th { font-family:'Syne',sans-serif; font-size:12px; font-weight:700; color:var(--gray-mid); text-transform:uppercase; letter-spacing:.06em; padding:14px 18px; text-align:left; background:var(--gray-light); }
        td { padding:16px 18px; border-bottom:1px solid #F0F0EC; font-size:15px; }
        tr:last-child td { border-bottom:none; }
        .avatar { width:44px; height:44px; background:var(--primary); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-family:'Syne',sans-serif; font-weight:800; font-size:18px; flex-shrink:0; }
    </style>
</head>
<body>

@include('front.layouts.header')

@yield('content')

@include('front.layouts.footer')

<script>lucide.createIcons();</script>
</body>
</html>