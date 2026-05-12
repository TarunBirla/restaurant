@extends('front.layouts.app')

@section('content')

    <div class="bg-gray-100 mx-auto max-w-7xl  px-5 py-10">

        <div class="container mx-auto">

            <div class="grid grid-cols-12 gap-8">

                <!-- SIDEBAR -->

                <div class="col-span-3">

                   @include('front.layouts.user-sidebar')

                </div>





                <!-- CONTENT -->

                <div class="col-span-9">

                    <div class="grid grid-cols-3 gap-6">

                        <div class="bg-white rounded-3xl shadow p-8">

                            <h3 class="text-gray-500 text-lg">

                                My Orders

                            </h3>

                            <h2 class="text-5xl font-bold mt-5">

                                {{ \App\Models\Order::where('user_id', auth()->id())->count() }}

                            </h2>

                        </div>
                        <div class="bg-white rounded-3xl shadow p-8">

                            <h3 class="text-gray-500 text-lg">

                                Total Spent

                            </h3>

                            <h2 class="text-5xl font-bold mt-5 text-green-600">

                                £{{ number_format(
        \App\Models\Payment::where(
            'user_id',
            auth()->id()
        )
            ->where('payment_status', 'paid')
            ->sum('amount'),
        2
    ) }}

                            </h2>

                        </div>

                        <div class="bg-white rounded-3xl shadow p-8">

                            <h3 class="text-gray-500 text-lg">

                                Cart Items

                            </h3>

                            <h2 class="text-5xl font-bold mt-5">

                                {{ count(session('cart', [])) }}

                            </h2>

                        </div>



                    </div>





                    <!-- RECENT ORDERS -->

                    <div class="bg-white rounded-3xl shadow mt-10 p-8">

                        <div class="flex justify-between items-center mb-8">

                            <h2 class="text-3xl font-bold">

                                Recent Orders

                            </h2>

                            <a href="/my-orders" class="text-red-500 font-bold">

                                View All

                            </a>

                        </div>

                        <table class="w-full">

                            <thead>

                                <tr class="border-b">

                                    <th class="text-left py-4">
                                        Order ID
                                    </th>

                                    <th class="text-left py-4">
                                        Amount
                                    </th>

                                    <th class="text-left py-4">
                                        Date
                                    </th>

                                    <th class="text-left py-4">
                                        Status
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach(\App\Models\Order::where('user_id', auth()->id())->latest()->take(5)->get() as $order)

                                    <tr class="border-b">

                                        <td class="py-5">

                                            #{{ $order->id }}

                                        </td>

                                        <td class="py-5">

                                            £{{ $order->total_amount }}

                                        </td>

                                        <td class="py-5">

                                            {{ $order->created_at->format('d M Y') }}

                                        </td>

                                        <td class="p-5">

                                            @if($order->status == 'pending')

                                                <span
                                                    class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Pending

                                                </span>

                                            @elseif($order->status == 'accepted')

                                                <span
                                                    class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Accepted

                                                </span>

                                            @elseif($order->status == 'completed')

                                                <span
                                                    class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Completed

                                                </span>

                                            @elseif($order->status == 'cancelled')

                                                <span
                                                    class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    Cancelled

                                                </span>

                                            @else

                                                <span
                                                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center gap-2">

                                                    {{ ucfirst($order->status) }}

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection