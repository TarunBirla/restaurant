<div class="card" style="padding:28px; position:sticky; top:90px;">
    <!-- USER INFO -->
    <div style="text-align:center; padding-bottom:24px; border-bottom:1px solid #F0F0EC;">
        <div style="width:72px; height:72px; background:#E8370E; border-radius:50%; margin:0 auto; display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; font-size:28px; color:#fff;">
            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
        </div>
        <h2 style="font-family:'Syne',sans-serif; font-weight:800; font-size:20px; margin:14px 0 4px;">{{ auth()->user()->name }}</h2>
        <p style="color:#6B7280; font-size:14px; margin:0;">{{ auth()->user()->email }}</p>
        <span style="display:inline-block; margin-top:10px; background:#FFF5F3; color:#E8370E; font-size:12px; font-weight:700; padding:4px 14px; border-radius:999px; font-family:'Syne',sans-serif; text-transform:capitalize;">{{ auth()->user()->role }}</span>
    </div>

    <!-- MENU -->
    <nav style="margin-top:20px; display:flex; flex-direction:column; gap:4px;">
        <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" style="display:flex; align-items:center; gap:10px;">
            <i data-lucide="layout-dashboard" style="width:16px; height:16px;"></i> Dashboard
        </a>
        <a href="/profile" class="sidebar-link {{ request()->is('profile') ? 'active' : '' }}" style="display:flex; align-items:center; gap:10px;">
            <i data-lucide="user" style="width:16px; height:16px;"></i> My Profile
        </a>
        <a href="/my-orders" class="sidebar-link {{ request()->is('my-orders') ? 'active' : '' }}" style="display:flex; align-items:center; gap:10px;">
            <i data-lucide="package" style="width:16px; height:16px;"></i> My Orders
        </a>
        <a href="/cart" class="sidebar-link {{ request()->is('cart') ? 'active' : '' }}" style="display:flex; align-items:center; gap:10px;">
            <i data-lucide="shopping-cart" style="width:16px; height:16px;"></i> Cart
        </a>
        <div style="border-top:1px solid #F0F0EC; margin:8px 0;"></div>
        <form method="POST" action="/logout">
            @csrf
            <button class="sidebar-link" style="width:100%; background:none; border:none; cursor:pointer; text-align:left; display:flex; align-items:center; gap:10px; color:#E8370E; font-weight:600;" onmouseover="this.style.background='#FFF5F3'" onmouseout="this.style.background='transparent'">
                <i data-lucide="log-out" style="width:16px; height:16px;"></i> Logout
            </button>
        </form>
    </nav>
</div>