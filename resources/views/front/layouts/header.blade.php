<header style="background:#fff; box-shadow:0 1px 0 #F0F0EC; position:sticky; top:0; z-index:50;">
    <div class="container mx-auto" style="max-width:1280px; padding:0 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:72px;">

            <!-- LOGO -->
            <a href="/" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                <div style="width:38px; height:38px; background:#E8370E; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i data-lucide="utensils" style="color:#fff; width:20px; height:20px;"></i>
                </div>
                <span style="font-family:'Syne',sans-serif; font-weight:800; font-size:22px; color:#0D0D0D;">Food<span style="color:#E8370E;">Rush</span></span>
            </a>

            <!-- NAV -->
            <nav style="display:flex; align-items:center; gap:6px;">
                <a href="/" style="padding:9px 16px; border-radius:10px; font-weight:500; color:#0D0D0D; text-decoration:none; font-size:15px; transition:background .18s;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">Home</a>

                @auth
                <a href="/cart" style="padding:9px 16px; border-radius:10px; font-weight:500; color:#0D0D0D; text-decoration:none; font-size:15px; display:flex; align-items:center; gap:6px;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">
                    <i data-lucide="shopping-cart" style="width:16px; height:16px;"></i> Cart
                </a>
                <a href="/my-orders" style="padding:9px 16px; border-radius:10px; font-weight:500; color:#0D0D0D; text-decoration:none; font-size:15px; display:flex; align-items:center; gap:6px;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='transparent'">
                    <i data-lucide="package" style="width:16px; height:16px;"></i> Orders
                </a>

                <!-- USER DROPDOWN -->
                <div style="position:relative;" onmouseenter="document.getElementById('dropdown').style.display='block'" onmouseleave="document.getElementById('dropdown').style.display='none'">
                    <button style="display:flex; align-items:center; gap:10px; background:#F5F5F0; border:none; padding:8px 14px 8px 8px; border-radius:12px; cursor:pointer; transition:background .18s;" onmouseover="this.style.background='#EBEBEB'" onmouseout="this.style.background='#F5F5F0'">
                        <div class="avatar" style="width:36px; height:36px; font-size:15px;">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                        <div style="text-align:left;">
                            <p style="font-family:'Syne',sans-serif; font-weight:700; font-size:14px; margin:0; line-height:1.3;">{{ auth()->user()->name }}</p>
                            <p style="font-size:11px; color:#6B7280; margin:0; text-transform:capitalize;">{{ auth()->user()->role }}</p>
                        </div>
                        <i data-lucide="chevron-down" style="width:15px; height:15px; color:#6B7280;"></i>
                    </button>
                    <div id="dropdown" style="display:none; position:absolute; right:0; top:100%; margin-top:6px; width:220px; background:#fff; border-radius:16px; box-shadow:0 12px 40px rgba(0,0,0,.13); overflow:hidden; z-index:100;">
                        <a href="/dashboard" style="display:flex; align-items:center; gap:10px; padding:14px 18px; text-decoration:none; color:#0D0D0D; font-size:14px; font-weight:500; transition:background .15s;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                            <i data-lucide="layout-dashboard" style="width:15px; height:15px; color:#E8370E;"></i> Dashboard
                        </a>
                        <a href="/profile" style="display:flex; align-items:center; gap:10px; padding:14px 18px; text-decoration:none; color:#0D0D0D; font-size:14px; font-weight:500; transition:background .15s;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                            <i data-lucide="user" style="width:15px; height:15px; color:#E8370E;"></i> My Profile
                        </a>
                        <a href="/my-orders" style="display:flex; align-items:center; gap:10px; padding:14px 18px; text-decoration:none; color:#0D0D0D; font-size:14px; font-weight:500; transition:background .15s;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                            <i data-lucide="package" style="width:15px; height:15px; color:#E8370E;"></i> My Orders
                        </a>
                        <a href="/cart" style="display:flex; align-items:center; gap:10px; padding:14px 18px; text-decoration:none; color:#0D0D0D; font-size:14px; font-weight:500; transition:background .15s;" onmouseover="this.style.background='#F5F5F0'" onmouseout="this.style.background='#fff'">
                            <i data-lucide="shopping-cart" style="width:15px; height:15px; color:#E8370E;"></i> Cart
                        </a>
                        <div style="border-top:1px solid #F0F0EC; margin:4px 0;"></div>
                        <form method="POST" action="/logout" style="margin:0;">
                            @csrf
                            <button style="display:flex; align-items:center; gap:10px; padding:14px 18px; width:100%; background:none; border:none; cursor:pointer; font-size:14px; font-weight:500; color:#E8370E; transition:background .15s;" onmouseover="this.style.background='#FFF5F3'" onmouseout="this.style.background='transparent'">
                                <i data-lucide="log-out" style="width:15px; height:15px;"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                @guest
                <a href="/login" class="btn-black" style="padding:10px 20px; font-size:14px; margin-left:4px; display:flex; align-items:center; gap:7px; text-decoration:none;">
                    <i data-lucide="log-in" style="width:15px; height:15px;"></i> Login
                </a>
                <a href="/register" class="btn-primary" style="padding:10px 20px; font-size:14px; display:flex; align-items:center; gap:7px; text-decoration:none;">
                    <i data-lucide="user-plus" style="width:15px; height:15px;"></i> Register
                </a>
                @endguest
            </nav>
        </div>
    </div>
</header>