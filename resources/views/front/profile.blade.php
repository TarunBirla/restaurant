@extends('front.layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

.profile-page {
    background: rgba(245, 240, 232, 0.95);
    min-height: 100vh;
    padding: 32px 16px 100px;
    /* font-family: 'DM Sans', sans-serif; */
}
.profile-wrap {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 24px;
    align-items: start;
}
.profile-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #E8E6E0;
    padding: 36px 32px;
}
.profile-title {
    /* font-family: 'Syne', sans-serif; */
    font-size: 28px;
    font-weight: 700;
    color: #111;
    margin: 0 0 28px;
}
.p-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 8px;
    letter-spacing: .02em;
}
.p-input {
    width: 100%;
    border: 1.5px solid #E8E6E0;
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 15px;
    /* font-family: 'DM Sans', sans-serif; */
    color: #111;
    background: #FAFAF8;
    outline: none;
    transition: border-color .2s, background .2s;
    box-sizing: border-box;
}
.p-input:focus { border-color: #E63946; background: #fff; }
.p-group { margin-bottom: 20px; }
.p-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.p-btn {
    background: #E63946;
    color: #fff;
    border: none;
    border-radius: 14px;
    padding: 16px 36px;
    /* font-family: 'Syne', sans-serif; */
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s, transform .15s;
    margin-top: 10px;
}
.p-btn:hover { background: #c42d0b; transform: translateY(-1px); }
.p-success {
    background: #DCFCE7;
    border: 1px solid #BBF7D0;
    color: #15803D;
    padding: 14px 18px;
    border-radius: 14px;
    margin-bottom: 24px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
.mob-page-title {
    display: none;
    /* font-family: 'Syne', sans-serif; */
    font-size: 26px;
    font-weight: 700;
    color: #111;
    margin-bottom: 18px;
}

@media(max-width: 900px) {
    .profile-wrap { grid-template-columns: 1fr; }
}
@media(max-width: 640px) {
    .profile-page { padding: 20px 14px 100px; }
    .mob-page-title { display: block; }
    .profile-card { padding: 24px 18px; }
    .p-grid { grid-template-columns: 1fr; gap: 0; }
    .p-btn { width: 100%; text-align: center; padding: 16px; }
}
</style>

<div class="profile-page">
    <div class="profile-wrap">

        {{-- SIDEBAR --}}
        <div>
            @include('front.layouts.user-sidebar')
        </div>

        {{-- CONTENT --}}
        <div>
            <div class="mob-page-title">My Profile</div>

            <div class="profile-card">
                <h1 class="profile-title">My Profile</h1>

                @if(session('success'))
                <div class="p-success">
                    <svg width="18" height="18" fill="none" stroke="#15803D" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="/profile/update">
                    @csrf

                    <div class="p-grid">
                        <div class="p-group">
                            <label class="p-label">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="p-input" required>
                        </div>
                        <div class="p-group">
                            <label class="p-label">Email Address</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="p-input" required>
                        </div>
                    </div>

                    <button type="submit" class="p-btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection