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
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts Created in Last 7 Days</h3>
            <div class="h-80">
                <canvas id="postsChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Posts</h3>
                <div class="divide-y divide-gray-100">
                    @forelse($recentPosts->take(3) as $post)
                        <div class="py-3">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="font-medium text-gray-800 hover:text-blue-600 transition-colors">{{ Str::limit($post->title, 40) }}</a>
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No recent posts found.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Messages</h3>
                <div class="divide-y divide-gray-100">
                    @forelse($recentContacts->take(2) as $contact)
                        <div class="py-3 flex items-center">
                            <img class="h-10 w-10 rounded-full mr-3" src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($contact->email))) }}?d=mp" alt="{{ $contact->name }}">
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
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('postsChart').getContext('2d');
        const lineChartData = @json($lineChartData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: lineChartData.labels,
                datasets: [{
                    label: 'Posts',
                    data: lineChartData.data,
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
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
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush