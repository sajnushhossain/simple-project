<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create($request->only('email'));

        return back()->with('message', [
            'type' => 'success',
            'text' => 'Thank you for subscribing to our newsletter!'
        ]);
    }
}
