@extends('front.layouts.app')

@section('content')

<style>
/* =============================================
   TRANSACTIONS PAGE — RESPONSIVE
   ============================================= */
.txn-page {
    background: rgba(245, 240, 232, 0.95);
    min-height: 100vh;
    padding: 32px 16px 100px;
}
.txn-wrap {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 24px;
    align-items: start;
}
.mob-page-title {
    display: none;
    font-size: 22px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
}

/* CARD */
.txn-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #E8E6E0;
    overflow: hidden;
}

/* HEADER */
.txn-header {
    padding: 24px 28px;
    border-bottom: 1px solid #F0EDE8;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
}
.txn-header h1 {
    font-size: 22px;
    font-weight: 700;
    color: #111;
    margin: 0 0 4px;
}
.txn-header p { font-size: 13px; color: #999; margin: 0; }
.txn-total {
    background: #DCFCE7;
    color: #15803D;
    padding: 10px 20px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
    flex-shrink: 0;
}

/* TABLE */
.txn-table { width: 100%; border-collapse: collapse; }
.txn-table thead tr { background: #F9F8F5; }
.txn-table thead th {
    padding: 12px 18px;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    color: #999;
    letter-spacing: .05em;
    text-transform: uppercase;
    white-space: nowrap;
}
.txn-table tbody tr {
    border-top: 1px solid #F0EDE8;
    transition: background .15s;
}
.txn-table tbody tr:hover { background: #FAFAF8; }
.txn-table tbody td {
    padding: 14px 18px;
    font-size: 13px;
    color: #222;
    vertical-align: middle;
}

/* BADGES */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}
.badge-online   { background: #DCFCE7; color: #15803D; }
.badge-cod      { background: #DBEAFE; color: #1D4ED8; }
.badge-paid     { background: #DCFCE7; color: #15803D; }
.badge-pending  { background: #FEF9C3; color: #A16207; }

.txn-id    { font-weight: 700; color: #374151; font-size: 13px; }
.txn-link  { color: #2563EB; font-weight: 600; text-decoration: none; font-size: 13px; }
.txn-link:hover { text-decoration: underline; }
.txn-amount { font-weight: 700; color: #16a34a; font-size: 14px; }
.txn-date   { color: #999; font-size: 12px; }
.txn-restaurant { font-size: 13px; color: #374151; }

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}
.empty-state .e-icon { font-size: 48px; margin-bottom: 14px; }
.empty-state h3 { font-size: 17px; font-weight: 700; color: #222; margin: 0 0 6px; }
.empty-state p  { color: #999; font-size: 13px; margin: 0; }

/* MOBILE CARD VIEW */
.txn-mob-list { display: none; }
.txn-mob-item {
    padding: 16px 18px;
    border-top: 1px solid #F0EDE8;
}
.txn-mob-item:first-child { border-top: none; }
.tmob-row1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.tmob-row2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.tmob-id { font-size: 14px; font-weight: 700; color: #111; }
.tmob-amount { font-size: 15px; font-weight: 700; color: #16a34a; }
.tmob-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.tmob-restaurant { font-size: 12px; color: #888; }
.tmob-date { font-size: 11px; color: #bbb; }
.tmob-order-link { font-size: 12px; color: #2563EB; text-decoration: none; font-weight: 600; }

@media(max-width: 900px) {
    .txn-wrap { grid-template-columns: 1fr; }
}
@media(max-width: 640px) {
    .txn-page { padding: 16px 12px 100px; }
    .mob-page-title { display: block; }
    .txn-header { padding: 16px 18px; }
    .txn-header h1 { font-size: 18px; }
    /* Switch to card layout */
    .txn-table { display: none; }
    .txn-mob-list { display: block; }
    .txn-card { border-radius: 18px; }
    .txn-total { font-size: 13px; padding: 8px 14px; }
}
@media(max-width: 400px) {
    .tmob-row2 { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="txn-page">
    <div class="txn-wrap">

        {{-- SIDEBAR --}}
        <div>
            @include('front.layouts.user-sidebar')
        </div>

        {{-- CONTENT --}}
        <div>
            <div class="mob-page-title">Transactions</div>

            <div class="txn-card">

                {{-- HEADER --}}
                <div class="txn-header">
                    <div>
                        <h1>My Transactions</h1>
                        <p>Payment history &amp; records</p>
                    </div>
                    <div class="txn-total">
                        Total: £{{ number_format($payments->sum('amount'), 2) }}
                    </div>
                </div>

                {{-- DESKTOP TABLE --}}
                <table class="txn-table">
                    <thead>
                        <tr>
                            <th>TXN ID</th>
                            <th>Order</th>
                            <th>Restaurant</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td><span class="txn-id">TXN-{{ $payment->id }}</span></td>
                            <td>
                                <a href="/my-orders/{{ $payment->order_id }}" class="txn-link">#{{ $payment->order_id }}</a>
                            </td>
                            <td>
                                <span class="txn-restaurant">{{ $payment->restaurant->name ?? '—' }}</span>
                            </td>
                            <td>
                                @if($payment->payment_method == 'online')
                                    <span class="badge badge-online"> Online</span>
                                @else
                                    <span class="badge badge-cod"> COD</span>
                                @endif
                            </td>
                            <td><span class="txn-amount">£{{ number_format($payment->amount, 2) }}</span></td>
                            <td>
                                @if($payment->payment_status == 'paid')
                                    <span class="badge badge-paid"> Paid</span>
                                @else
                                    <span class="badge badge-pending"> Pending</span>
                                @endif
                            </td>
                            <td><span class="txn-date">{{ $payment->created_at->format('d M Y') }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="e-icon">💳</div>
                                    <h3>No Transactions Found</h3>
                                    <p>Your payment history will appear here.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- MOBILE CARD LIST --}}
                <div class="txn-mob-list">
                    @forelse($payments as $payment)
                    <div class="txn-mob-item">
                        <div class="tmob-row1">
                            <span class="tmob-id">TXN-{{ $payment->id }}</span>
                            <span class="tmob-amount">£{{ number_format($payment->amount, 2) }}</span>
                        </div>
                        <div class="tmob-row2">
                            <div class="tmob-meta">
                                <span class="tmob-restaurant">{{ $payment->restaurant->name ?? '—' }}</span>
                                <span class="tmob-date">{{ $payment->created_at->format('d M Y') }}</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                @if($payment->payment_method == 'online')
                                    <span class="badge badge-online"> Online</span>
                                @else
                                    <span class="badge badge-cod"> COD</span>
                                @endif
                                @if($payment->payment_status == 'paid')
                                    <span class="badge badge-paid"> Paid</span>
                                @else
                                    <span class="badge badge-pending"> Pending</span>
                                @endif
                                <a href="/my-orders/{{ $payment->order_id }}" class="tmob-order-link">Order #{{ $payment->order_id }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="txn-mob-item">
                        <div class="empty-state">
                            <div class="e-icon">💳</div>
                            <h3>No Transactions Found</h3>
                            <p>Your payment history will appear here.</p>
                        </div>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>

@endsection