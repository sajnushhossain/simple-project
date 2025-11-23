<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $role = $request->get('role');

        $usersQuery = User::query();

        if ($role) {
            $usersQuery->where('role', $role);
        }

        $users = $usersQuery->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->email === 'sajnushhossain.cse@gmail.com') {
            return back()->with('error', 'You cannot delete the default admin user.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Update the role of a specific user.
     */
    public function updateRole(Request $request, User $user)
    {
        if ($user->email === 'sajnushhossain.cse@gmail.com') {
            return response()->json(['error' => 'You cannot change the role of the default admin user.'], 403);
        }

        $validated = $request->validate([
            'role' => 'required|string|in:admin,user,moderator',
        ]);

        try {
            $user->update(['role' => $validated['role']]);

            return response()->json(['success' => 'User role updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating user role: '.$e->getMessage());

            $errorData = ['error' => 'There was an error updating the user role. Please try again.'];
            if (config('app.debug')) {
                $errorData['exception'] = $e->getMessage();
            }

            return response()->json($errorData, 500);
        }
    }
}
