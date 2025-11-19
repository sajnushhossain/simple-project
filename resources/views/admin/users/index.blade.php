@extends('admin.layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center mb-8 space-y-4 md:space-y-0">
        <h1 class="text-3xl font-bold text-gray-800">Local Users</h1>
        <div class="flex flex-col md:flex-row items-stretch md:items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="relative w-full md:w-auto">
                <button id="copyAllButton" type="button"
                        class="inline-flex items-center justify-center w-full px-6 py-2 bg-blue-500 text-white text-base font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-300 cursor-pointer">
                    Copy All Emails
                </button>
            </div>
            <div class="relative w-full md:w-auto">
                <button id="sortButton" type="button"
                        class="inline-flex items-center justify-center w-full px-6 py-2 bg-gray-100 text-gray-700 text-base font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-300 cursor-pointer">
                    Sort By
                    <i id="sortIcon" class="fa-solid fa-angle-down ml-2 transition-transform duration-300"></i>
                </button>
                <div id="sortDropdown"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => 'asc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Name (A-Z)</a>
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => 'desc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Name (Z-A)</a>
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'email', 'sort_order' => 'asc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (A-Z)</a>
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'email', 'sort_order' => 'desc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (Z-A)</a>
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'created_at', 'sort_order' => 'asc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Created At (Oldest)</a>
                    <a href="{{ route('admin.users.index', array_merge(request()->query(), ['sort_by' => 'created_at', 'sort_order' => 'desc'])) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Created At (Newest)</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4 flex space-x-2">
        @php
            $allQuery = request()->query();
            unset($allQuery['role']);
        @endphp
        <a href="{{ route('admin.users.index', $allQuery) }}" class="px-4 py-2 rounded-md text-sm font-medium {{ !request('role') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">All</a>
        <a href="{{ route('admin.users.index', array_merge(request()->query(), ['role' => 'admin'])) }}" class="px-4 py-2 rounded-md text-sm font-medium {{ request('role') == 'admin' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Admin</a>
        <a href="{{ route('admin.users.index', array_merge(request()->query(), ['role' => 'user'])) }}" class="px-4 py-2 rounded-md text-sm font-medium {{ request('role') == 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">User</a>
        <a href="{{ route('admin.users.index', array_merge(request()->query(), ['role' => 'moderator'])) }}" class="px-4 py-2 rounded-md text-sm font-medium {{ request('role') == 'moderator' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Moderator</a>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Name</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Email</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Role</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Created At</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4 text-gray-800">{{ $user->name }}</td>
                            <td class="py-4 px-4 text-gray-800">{{ $user->email }}</td>
                            <td class="py-4 px-4 text-gray-500">
                                <select name="roles[{{ $user->id }}]" class="form-select rounded-md shadow-sm w-full cursor-pointer">
                                    <!-- <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option> -->
                                    <option value="user" @if($user->role === 'user') selected @endif>User</option>
                                    <option value="moderator" @if($user->role === 'moderator') selected @endif>Moderator</option>
                                </select>
                            </td>
                            <td class="py-4 px-4 text-gray-500">{{ $user->created_at->format('F d, Y') }}</td>
                            <td class="py-4 px-4 text-center">
                                <button class="update-role-btn text-black-600 hover:text-blue-800 font-semibold cursor-pointer x-4 py-2 px-2 rounded-lg" data-user-id="{{ $user->id }}">
                                    Update Role
                                </button>
                                <button class="copy-email-btn cursor-pointer text-blue-600 hover:text-blue-800 mr-4 font-semibold" data-email="{{ $user->email }}">
                                    Copy Email
                                </button>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 cursor-pointer hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $users->appends(request()->query())->links('vendor.pagination.tailwind') }}
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
            if (button.id === 'copyAllButton') {
                toast.textContent = 'All emails copied to clipboard!';
            } else {
                toast.textContent = 'Email copied to clipboard!';
            }

            toast.classList.remove('hidden');

            if (button.id !== 'copyAllButton') {
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

        // Copy all button functionality
        document.getElementById('copyAllButton').addEventListener('click', function() {
            const emails = Array.from(document.querySelectorAll('.copy-email-btn')).map(btn => btn.dataset.email);
            if (emails.length === 0) return;

            const emailString = emails.join(', ');

            if (navigator.clipboard) {
                navigator.clipboard.writeText(emailString).then(() => {
                    showToast(this);
                }).catch(err => {
                    fallbackCopy(emailString, this);
                });
            } else {
                fallbackCopy(emailString, this);
            }
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

        // Handle role update for each user
        document.querySelectorAll('.update-role-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const select = document.querySelector(`select[name="roles[${userId}]"]`);
                const newRole = select.value;

                updateUserRole(userId, newRole);
            });
        });

        function updateUserRole(userId, newRole) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/admin/users/${userId}/update-role`, {
                method: 'POST',
                body: JSON.stringify({ role: newRole }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            }).then(data => {
                if (data.success) {
                    // Find the toast element and update its content
                    const toast = document.getElementById('copy-toast');
                    toast.textContent = data.success;
                    toast.classList.remove('hidden', 'bg-red-500');
                    toast.classList.add('bg-green-500');
                    
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 3000);
                } else {
                    const toast = document.getElementById('copy-toast');
                    toast.textContent = data.error || 'An unknown error occurred.';
                    toast.classList.remove('hidden', 'bg-green-500');
                    toast.classList.add('bg-red-500');
                    
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 3000);
                }
            }).catch(error => {
                const toast = document.getElementById('copy-toast');
                toast.textContent = 'There was an error updating the user role. Please try again.';
                toast.classList.remove('hidden', 'bg-green-500');
                toast.classList.add('bg-red-500');

                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 3000);
            });
        }
    });
</script>