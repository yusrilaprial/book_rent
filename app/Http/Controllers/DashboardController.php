<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        $sekarang = RentLogs::whereDate('created_at', Carbon::today())->count();
        $satuhari = RentLogs::whereDate('created_at', Carbon::today()->subDays(1))->count() ?? null;
        $duahari = RentLogs::whereDate('created_at', Carbon::today()->subDays(2))->count() ?? null;
        $tigahari = RentLogs::whereDate('created_at', Carbon::today()->subDays(3))->count() ?? null;
        $empathari = RentLogs::whereDate('created_at', Carbon::today()->subDays(4))->count() ?? null;
        $limahari = RentLogs::whereDate('created_at', Carbon::today()->subDays(5))->count() ?? null;
        $enamhari = RentLogs::whereDate('created_at', Carbon::today()->subDays(6))->count() ?? null;
        $tujuhhari = RentLogs::whereDate('created_at', Carbon::today()->subDays(7))->count() ?? null;
        
        return view('dashboard', [
            'book_count' => $bookCount, 
            'category_count' => $categoryCount, 
            'user_count' => $userCount, 
            'rentlogs' => $rentlogs, 
            'sekarang' => $sekarang,
            'satuhari' => $satuhari,
            'duahari' => $duahari,
            'tigahari' => $tigahari,
            'empathari' => $empathari,
            'limahari' => $limahari,
            'enamhari' => $enamhari,
            'tujuhhari' => $tujuhhari,
        ]);
    }
}
