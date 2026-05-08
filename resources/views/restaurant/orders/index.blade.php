@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">

    Restaurant Orders

</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-5 text-left">
                    Order ID
                </th>

                <th class="p-5 text-left">
                    User
                </th>

                <th class="p-5 text-left">
                    Amount
                </th>

                <th class="p-5 text-left">
                    Status
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($orders as $order)

            <tr class="border-t">

                <td class="p-5">

                    #{{ $order->id }}

                </td>

                <td class="p-5">

                    {{ $order->user->name ?? '' }}

                </td>

                <td class="p-5">

                    €{{ $order->total_amount }}

                </td>

                <td class="p-5">

                    <span
                    class="bg-green-100 text-green-700 px-4 py-1 rounded-full">

                        {{ $order->status }}

                    </span>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4"
                class="text-center py-20 text-gray-500">

                    No Orders Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection