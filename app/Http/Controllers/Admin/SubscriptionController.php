<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('admin.subscriptions.index', [
            'subscriptions' => Subscription::latest()->paginate(10),
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return back()->with('success', 'Subscription deleted successfully.');
    }
}
