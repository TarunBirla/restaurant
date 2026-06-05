<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Customer Create Complaint
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'subject'       => 'required|max:255',
            'complaint'     => 'required',
            'order_id'      => 'nullable',
            'product_id'    => 'nullable',
        ]);

        Complaint::create([
            'user_id'       => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'order_id'      => $request->order_id,
            'product_id'    => $request->product_id,
            'subject'       => $request->subject,
            'complaint'     => $request->complaint,
            'status'        => 'Pending',
        ]);

        return back()->with(
            'success',
            'Complaint submitted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Customer View Own Complaints
    |--------------------------------------------------------------------------
    */
    public function myComplaints()
    {
        $complaints = Complaint::with([
            'restaurant',
            'order',
            'product'
        ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->paginate(20);

        return view(
            'complaints.my',
            compact('complaints')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Restaurant Complaints
    |--------------------------------------------------------------------------
    */
    public function restaurantComplaints()
    {
        $restaurantId = auth()->user()->restaurant_id;

        $complaints = Complaint::with([
            'user',
            'order',
            'product'
        ])
        ->where(
            'restaurant_id',
            $restaurantId
        )
        ->latest()
        ->paginate(20);

        return view(
            'restaurant.complaints.index',
            compact('complaints')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Restaurant Reply
    |--------------------------------------------------------------------------
    */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'restaurant_reply' => 'required'
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'restaurant_reply' => $request->restaurant_reply,
            'status'           => 'Restaurant Replied',
            'replied_at'       => now(),
        ]);

        return back()->with(
            'success',
            'Reply sent successfully.'
        );
    }
}