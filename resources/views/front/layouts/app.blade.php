<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYST — Premium Food Delivery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {!! LaravelPWA::meta() !!}
    <style>
        :root {
            --primary: #E8370E;
            --primary-dark: #C42D0A;
            --primary-light: #FFF0EC;
            --black: #0D0D0D;
            --gray-mid: #6B7280;
            --gray-light: #F5F5F0;
            --success: #16A34A;
            --success-light: #DCFCE7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gray-light);
            color: var(--black);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            border-radius: 12px;
            transition: all .2s;
            display: inline-block;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(232, 55, 14, .35);
        }

        .btn-black {
            background: var(--black);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            border-radius: 12px;
            transition: all .2s;
            display: inline-block;
        }

        .btn-black:hover {
            background: #333;
            transform: translateY(-1px);
        }

        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .07);
        }

        .badge-primary {
            background: var(--primary);
            color: #fff;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            font-family: 'Poppins', sans-serif;
            letter-spacing: .03em;
        }

        .badge-success {
            background: var(--success-light);
            color: var(--success);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 14px;
        }

        .sidebar-link {
            display: block;
            padding: 13px 18px;
            border-radius: 12px;
            font-weight: 500;
            transition: all .18s;
            color: var(--black);
            text-decoration: none;
        }

        .sidebar-link:hover {
            background: var(--gray-light);
        }

        .sidebar-link.active {
            background: var(--primary);
            color: #fff;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            border: 1.5px solid #E5E5E0;
            border-radius: 12px;
            padding: 13px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            width: 100%;
            outline: none;
            transition: border .18s;
            background: #FAFAF8;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
        }

        label {
            font-weight: 600;
            font-size: 13px;
            display: block;
            margin-bottom: 7px;
            font-family: 'Poppins', sans-serif;
        }

        th {
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: var(--gray-mid);
            text-transform: uppercase;
            letter-spacing: .07em;
            padding: 14px 18px;
            text-align: left;
            background: var(--gray-light);
        }

        td {
            padding: 16px 18px;
            border-bottom: 1px solid #F0F0EC;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .avatar {
            width: 44px;
            height: 44px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 18px;
            flex-shrink: 0;
        }

        /* ── HEADER RESPONSIVE ── */
        .desktop-nav {
            display: flex;
        }

        .mobile-toggle {
            display: none;
        }

        .mobile-menu {
            display: none;
        }

        @media(max-width:992px) {
            .desktop-nav {
                display: none !important;
            }

            .mobile-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border: none;
                background: #F5F5F0;
                border-radius: 12px;
                cursor: pointer;
            }

            .mobile-menu {
                display: none;
                background: #fff;
                border-top: 1px solid #F0F0EC;
                padding: 16px 20px 20px;
            }

            .mobile-menu.active {
                display: block;
            }

            .mobile-menu a {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 13px 0;
                text-decoration: none;
                color: #111827;
                border-bottom: 1px solid #F3F4F6;
                font-weight: 500;
                font-size: 14px;
            }

            .mobile-menu a:last-child {
                border-bottom: none;
            }
        }

        /* ── FOOTER RESPONSIVE ── */
        @media(max-width:900px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 36px !important;
            }
        }

        @media(max-width:560px) {
            .footer-grid {
                grid-template-columns: 1fr !important;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }

        /* ── HOME PAGE RESPONSIVE ── */
        @media(max-width:900px) {
            .hero-title {
                font-size: 36px !important;
            }

            .hero-stats {
                gap: 20px !important;
            }

            .categories-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .offer-grid {
                grid-template-columns: 1fr !important;
            }

            .offer-img {
                display: none !important;
            }

            .qr-wrapper {
                grid-template-columns: 1fr !important;
                text-align: center;
            }

            .qr-title {
                font-size: 30px !important;
            }
        }

        @media(max-width:600px) {
            .hero-title {
                font-size: 26px !important;
            }

            .section-title {
                font-size: 26px !important;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .products-grid {
                grid-template-columns: 1fr !important;
            }

            .features-grid {
                grid-template-columns: 1fr !important;
            }

            .hero-stats {
                flex-wrap: wrap;
                gap: 16px !important;
            }

            .hero-cta {
                flex-direction: column !important;
            }

            .offer-title {
                font-size: 32px !important;
            }
        }
    </style>
</head>

<body>
    @include('front.layouts.header')
    @yield('content')
    @include('front.layouts.footer')
    <script>lucide.createIcons();</script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="module">

        console.log('FCM START');

        import { initializeApp }

            from
            "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";

        import {

            getMessaging,
            getToken,
            onMessage

        }

            from
            "https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging.js";

        const firebaseConfig = {

            apiKey:
                "{{ config('services.firebase.api_key') }}",

            authDomain:
                "{{ config('services.firebase.auth_domain') }}",

            projectId:
                "{{ config('services.firebase.project_id') }}",

            storageBucket:
                "{{ config('services.firebase.storage_bucket') }}",

            messagingSenderId:
                "{{ config('services.firebase.sender_id') }}",

            appId:
                "{{ config('services.firebase.app_id') }}",

            measurementId:
                "{{ config('services.firebase.measurement_id') }}"

        };

        const app =
            initializeApp(firebaseConfig);

        console.log('FIREBASE INITIALIZED');

        const messaging =
            getMessaging(app);

        Notification.requestPermission()

            .then(async (permission) => {

                console.log('PERMISSION:', permission);

                if (permission === 'granted') {

                    console.log('PERMISSION GRANTED');

                    const registration =
                        await navigator.serviceWorker.register(
                            '/firebase-messaging-sw.js'
                        );

                    console.log(
                        'SERVICE WORKER REGISTERED'
                    );

                    const token =
                        await getToken(

                            messaging,

                            {

                                vapidKey:"{{ config('services.firebase.vapid_key') }}",

                                serviceWorkerRegistration:
                                    registration
                            }

                        );

                    console.log(
                        'FCM TOKEN:',
                        token
                    );

                    if (token) {

                        fetch('/save-fcm-token', {

                            method: 'POST',

                            headers: {

                                'Content-Type':
                                    'application/json',

                                'X-CSRF-TOKEN':

                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content
                            },

                            body: JSON.stringify({

                                token: token

                            })
                        });

                        console.log(
                            'TOKEN SAVED'
                        );
                    }
                }

            }).catch((error) => {

                console.log(
                    'FCM ERROR:',
                    error
                );

            });

        onMessage(messaging, (payload) => {

            console.log(
                'NOTIFICATION',
                payload
            );

            alert(

                payload.notification.title

                + '\n\n'

                +

                payload.notification.body

            );

            new Notification(

                payload.notification.title,

                {

                    body:
                        payload.notification.body

                }

            );

        });

    </script>
</body>

</html>