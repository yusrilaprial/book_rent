<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;

class DashboardController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->orderByDesc('updated_at')->paginate(5);
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view('dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'rentlogs' => $rentlogs]);
    }
}
