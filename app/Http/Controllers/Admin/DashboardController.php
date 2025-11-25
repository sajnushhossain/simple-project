<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ModeratorAccessInfoExport;
use App\Exports\WebsiteDataExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $postsCount = Post::count();
        $recentPosts = Post::latest()->take(5)->get();

        $postsByDay = Post::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }

        $lineChartData = [
            'labels' => $dates->map(fn($date) => \Carbon\Carbon::parse($date)->format('M d')),
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $dates->map(fn($date) => $postsByDay->get($date, 0)),
                    'borderColor' => '#4F46E5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
        ];

        if ($user->role === 'admin') {
            $categoriesCount = Category::count();
            $contactsCount = Contact::count();
            $subscriptionsCount = Subscription::count();
            $recentContacts = Contact::latest()->take(5)->get();

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
            
            $lineChartData['datasets'][] = [
                'label' => 'Contacts',
                'data' => $dates->map(fn($date) => $contactsByDay->get($date, 0)),
                'borderColor' => '#10B981',
                'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                'fill' => true,
                'tension' => 0.4,
            ];
            
            $lineChartData['datasets'][] = [
                'label' => 'Subscriptions',
                'data' => $dates->map(fn($date) => $subscriptionsByDay->get($date, 0)),
                'borderColor' => '#EF4444',
                'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                'fill' => true,
                'tension' => 0.4,
            ];

            $pieChartData = [
                'labels' => ['Posts', 'Categories', 'Contacts', 'Subscriptions'],
                'data' => [$postsCount, $categoriesCount, $contactsCount, $subscriptionsCount],
            ];

            return view('admin.dashboard', compact(
                'postsCount', 'categoriesCount', 'contactsCount', 'subscriptionsCount', 
                'recentPosts', 'recentContacts', 'lineChartData', 'pieChartData'
            ));
        }

        return view('admin.dashboard', compact('postsCount', 'recentPosts', 'lineChartData'));
    }

    public function download()
    {
        return Excel::download(new WebsiteDataExport, 'monthly-summary.xlsx');
    }

    public function downloadModeratorAccessInfo()
    {
        return Excel::download(new ModeratorAccessInfoExport, 'moderator-access-info.xlsx');
    }
}
