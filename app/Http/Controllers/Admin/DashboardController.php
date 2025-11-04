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
            ->pluck('count', 'date');

        $contactsByDay = Contact::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        $subscriptionsByDay = Subscription::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $lineChartData = [
            'labels' => $dates->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('M d');
            }),
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $dates->map(function ($date) use ($postsByDay) {
                        return $postsByDay->get($date, 0);
                    }),
                    'borderColor' => '#4F46E5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Contacts',
                    'data' => $dates->map(function ($date) use ($contactsByDay) {
                        return $contactsByDay->get($date, 0);
                    }),
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4
                ],
                [
                    'label' => 'Subscriptions',
                    'data' => $dates->map(function ($date) use ($subscriptionsByDay) {
                        return $subscriptionsByDay->get($date, 0);
                    }),
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.4
                ]
            ]
        ];

        $pieChartData = [
            'labels' => ['Posts', 'Categories', 'Contacts', 'Subscriptions'],
            'data' => [$postsCount, $categoriesCount, $contactsCount, $subscriptionsCount],
        ];

        return view('admin.dashboard', [
            'postsCount' => $postsCount,
            'categoriesCount' => $categoriesCount,
            'contactsCount' => $contactsCount,
            'subscriptionsCount' => $subscriptionsCount,
            'recentPosts' => $recentPosts,
            'recentContacts' => $recentContacts,
            'lineChartData' => $lineChartData,
            'pieChartData' => $pieChartData,
        ]);
    }
}
