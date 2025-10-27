@extends('admin.layouts.app')

@section('title', 'Manage Subscriptions')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Subscriptions</h1>
        <div class="flex items-center space-x-4">
            <form action="{{ route('admin.subscriptions.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search by Email..." value="{{ request('search') }}"
                    class="bg-gray-100 border-2 border-gray-200 rounded-lg px-4 py-2 w-64 focus:outline-none focus:border-blue-500">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', 'created_at') }}">
                <input type="hidden" name="sort_order" value="{{ request('sort_order', 'desc') }}">
            </form>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                            <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'email', 'sort_order' => request('sort_by') === 'email' && request('sort_order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Email
                            </a>
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                            <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'created_at', 'sort_order' => request('sort_by') === 'created_at' && request('sort_order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Subscribed At
                            </a>
                        </th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($subscriptions as $subscription)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4 text-gray-800">{{ $subscription->email }}</td>
                            <td class="py-4 px-4 text-gray-500">{{ $subscription->created_at->format('F d, Y') }}</td>
                            <td class="py-4 px-4 text-center">
                                <button class="copy-email-btn cursor-pointer text-blue-600 hover:text-blue-800 mr-4 font-semibold" data-email="{{ $subscription->email }}">
                                    Copy
                                </button>
                                <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 cursor-pointer hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-500">
                                No subscriptions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $subscriptions->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>

<div id="copy-toast" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg hidden z-50">
    Email copied to clipboard!
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-email-btn');
        const toast = document.getElementById('copy-toast');

        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const email = this.dataset.email;

                if (navigator.clipboard) {
                    navigator.clipboard.writeText(email).then(() => {
                        showToast(this);
                    }).catch(err => {
                        fallbackCopy(email, this);
                    });
                } else {
                    fallbackCopy(email, this);
                }
            });
        });

        function fallbackCopy(text, button) {
            const input = document.createElement('input');
            input.style.position = 'fixed';
            input.style.opacity = 0;
            input.value = text;
            document.body.appendChild(input);
            input.select();
            try {
                document.execCommand('copy');
                showToast(button);
            } catch (err) {
                console.error('Fallback copy failed', err);
            }
            document.body.removeChild(input);
        }

        function showToast(button) {
            toast.classList.remove('hidden');
            if (button) {
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = originalText;
                }, 2000);
            }
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
    });
</script>
@endpush