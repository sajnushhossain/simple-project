@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="bg-blue-100 text-blue-600 h-12 w-12 flex items-center justify-center rounded-full mr-4">
                <i class="fas fa-pencil-alt text-xl"></i>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Posts</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $postsCount }}</p>
            </div>
        </div>
    </div>
    @if(Auth::user()->role === 'admin')
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="bg-green-100 text-green-600 h-12 w-12 flex items-center justify-center rounded-full mr-4">
                <i class="fas fa-folder text-xl"></i>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Categories</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $categoriesCount }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="bg-yellow-100 text-yellow-600 h-12 w-12 flex items-center justify-center rounded-full mr-4">
                <i class="fas fa-envelope text-xl"></i>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Messages</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $contactsCount }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="bg-red-100 text-red-600 h-12 w-12 flex items-center justify-center rounded-full mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Subscribers</h3>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $subscriptionsCount }}</p>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="{{ Auth::user()->role === 'admin' ? 'lg:col-span-2' : 'lg:col-span-3' }} bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Activity in Last 7 Days</h3>
        <div>
            <div class="w-full h-80">
                <canvas id="postsChart"></canvas>
            </div>
            @if(isset($pieChartData))
            <div class="w-full h-80 mt-8">
                <canvas id="pieChart"></canvas>
            </div>
            @endif
        </div>
    </div>

    <div class="lg:col-span-1 space-y-8">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Posts</h3>
            <div class="divide-y divide-gray-100">
                @forelse($recentPosts->take(3) as $post)
                <div class="py-3">
                    <a href="{{ route('admin.posts.edit', $post) }}"
                        class="font-medium text-gray-800 hover:text-blue-600 transition-colors">{{ Str::limit($post->title, 40) }}</a>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <p class="text-gray-500">No recent posts found.</p>
                @endforelse
            </div>
        </div>

        @if(Auth::user()->role === 'admin')
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Messages</h3>
            <div class="divide-y divide-gray-100">
                @forelse($recentContacts->take(2) as $contact)
                <div class="py-3 flex items-center">
                    <img class="h-10 w-10 rounded-full mr-3"
                        src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($contact->email))) }}?d=mp"
                        alt="{{ $contact->name }}">
                    <div>
                        <p class="font-medium text-gray-800">{{ $contact->name }}</p>
                        <p class="text-sm text-gray-500">{{ Str::limit($contact->subject, 20) }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500">No recent messages found.</p>
                @endforelse
            </div>
        </div>
        
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.dashboard.download') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-download mr-2"></i> Download Monthly Sheet
            </a>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.dashboard.downloadModeratorAccessInfo') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-download mr-2"></i> Download Moderator Access Info
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('postsChart').getContext('2d');
    const lineChartData = @json($lineChartData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: lineChartData.labels,
            datasets: lineChartData.datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });

    @if(isset($pieChartData))
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChartData = @json($pieChartData);

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieChartData.labels,
            datasets: [{
                data: pieChartData.data,
                backgroundColor: [
                    '#4F46E5',
                    '#F59E0B',
                    '#10B981',
                    '#EF4444',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
    @endif
});
</script>
@endpush