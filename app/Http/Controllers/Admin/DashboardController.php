<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Contact;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $contactsCount = Contact::count();
        $subscriptionsCount = Subscription::count();
        $recentPosts = Post::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        $postsByDay = Post::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $lineChartData = [
            'labels' => $postsByDay->pluck('date')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('M d');
            }),
            'data' => $postsByDay->pluck('count'),
        ];

        return view('admin.dashboard', [
            'postsCount' => $postsCount,
            'categoriesCount' => $categoriesCount,
            'contactsCount' => $contactsCount,
            'subscriptionsCount' => $subscriptionsCount,
            'recentPosts' => $recentPosts,
            'recentContacts' => $recentContacts,
            'lineChartData' => $lineChartData,
        ]);
    }
}
