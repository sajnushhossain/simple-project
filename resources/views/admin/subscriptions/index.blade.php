@extends('admin.layouts.app')

@section('title', 'Manage Subscriptions')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center mb-8 space-y-4 md:space-y-0">
        <h1 class="text-3xl font-bold text-gray-800">Subscriptions</h1>
        <div class="flex flex-col md:flex-row items-stretch md:items-center space-y-4 md:space-y-0 md:space-x-4">

            <div class="relative w-full md:w-auto">
                <button id="sortButton"
                        class="inline-flex items-center justify-center w-full px-6 py-2 bg-gray-100 text-gray-700 text-base font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-300">
                    Sort By
                    <i id="sortIcon" class="fa-solid fa-angle-down ml-2 transition-transform duration-300"></i>
                </button>
                <div id="sortDropdown"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'email', 'sort_order' => 'asc', 'search' => request('search')]) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (A-Z)</a>
                    <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'email', 'sort_order' => 'desc', 'search' => request('search')]) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (Z-A)</a>
                    <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'created_at', 'sort_order' => 'asc', 'search' => request('search')]) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Subscribed At (Oldest)</a>
                    <a href="{{ route('admin.subscriptions.index', ['sort_by' => 'created_at', 'sort_order' => 'desc', 'search' => request('search')]) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Subscribed At (Newest)</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                Email
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                Subscribed At
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

        // Sort button functionality
        document.getElementById('sortButton').addEventListener('click', function() {
            document.getElementById('sortDropdown').classList.toggle('hidden');
            document.getElementById('sortIcon').classList.toggle('rotate-180');
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('#sortButton') && !event.target.closest('#sortDropdown')) {
                var dropdown = document.getElementById('sortDropdown');
                var icon = document.getElementById('sortIcon');
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        });
    });
</script>
@endpush