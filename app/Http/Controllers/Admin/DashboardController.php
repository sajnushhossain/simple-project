<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $contactsCount = Contact::count();

        return view('admin.dashboard', compact('postsCount', 'categoriesCount', 'contactsCount'));
    }
}
