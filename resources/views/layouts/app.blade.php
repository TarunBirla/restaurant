<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    
       @laravelPWA

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #111827;
        }

        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 4px;
        }


        #sidebar {
            width: 260px;
            height: 100vh;
            background: #0D0D0D;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;

            /* IMPORTANT */

            overflow: hidden;
        }

        #main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: rgba(245, 240, 232, 0.95);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #9CA3AF;
            text-decoration: none;
            transition: all .18s;
            margin: 2px 0;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .nav-link.active {
            background: #C25A2A;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(232, 55, 14, .35);
        }

        .nav-link .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Alert */
        .alert-success {
            background: #DCFCE7;
            border: 1px solid #86EFAC;
            color: #15803D;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 22px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Mobile */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 40;
        }

        .mobile-menu-btn {
            display: none;
        }

        @media(max-width: 1024px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            #main-content {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: flex !important;
            }

            #sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div id="sidebar-overlay" onclick="closeSidebar()"></div>
    @include('layouts.sidebar')
    <div id="main-content">
        @include('layouts.navbar')

        <div style="padding: 28px 28px;">
            @if(session('success'))
                <div class="alert-success">
                    <i data-lucide="circle-check" style="width:18px; height:18px; flex-shrink:0;"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    style="background:#FEE2E2; border:1px solid #FCA5A5; color:#DC2626; border-radius:12px; padding:14px 18px; margin-bottom:22px; font-size:14px; font-weight:500; display:flex; align-items:center; gap:10px;">
                    <i data-lucide="circle-x" style="width:18px; height:18px; flex-shrink:0;"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebar-overlay').classList.add('active');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="module">

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

        const messaging =
            getMessaging(app);

        navigator.serviceWorker.register(

            '/firebase-messaging-sw.js'

        ).then(async (registration) => {

            const token = await getToken(

                messaging,

                {

                    vapidKey: "{{ config('services.firebase.vapid_key') }}",

                    serviceWorkerRegistration:
                        registration
                }

            );

            console.log(token);

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
            }
        });

        onMessage(messaging, (payload) => {

            console.log(
                'MESSAGE RECEIVED',
                payload
            );

            alert(
                payload.notification.title
                + ' - ' +
                payload.notification.body
            );

        });
    </script>

    <!-- INSTALL POPUP -->

<div
id="installPopup"

style="
display:none;
position:fixed;
inset:0;
background:rgba(0,0,0,.6);
z-index:999999;
justify-content:center;
align-items:center;
">

<div
style="
width:350px;
background:white;
padding:30px;
border-radius:20px;
text-align:center;
">

<h2>

Install HYST

</h2>

<p>

Install app for better experience.

</p>

<button

id="installBtn"

style="
background:#C25A2A;
color:white;
padding:14px 30px;
border:none;
border-radius:10px;
margin-top:20px;
cursor:pointer;
">

Install

</button>

<br>

<button

onclick="closeInstall()"

style="
margin-top:12px;
">

Later

</button>

</div>

</div>
<script>

let deferredPrompt;

function closeInstall(){

document
.getElementById(
'installPopup'
)
.style.display='none';

}

window.addEventListener(

'beforeinstallprompt',

(e)=>{

console.log(
'INSTALL READY'
);

e.preventDefault();

deferredPrompt=e;

setTimeout(()=>{

document
.getElementById(
'installPopup'
)
.style.display='flex';

},3000);

}

);

document

.getElementById(
'installBtn'
)

.addEventListener(

'click',

async()=>{

if(!deferredPrompt){

alert(

'Install unavailable'

);

return;

}

deferredPrompt.prompt();

await deferredPrompt.userChoice;

closeInstall();

}

);

window.addEventListener(

'appinstalled',

()=>{

alert(

'App Installed'

);

closeInstall();

}

);

</script>

</body>

</html>