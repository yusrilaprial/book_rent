<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', '1')->where('status', 'active')->get();
        $books = Book::where('status', 'in stock')->get();
        return view('book-rent', ['users' => $users, 'books' => $books]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if ($book['status'] != 'in stock') {
            Session::flash('status', 'danger');
            Session::flash('message', 'Cannot rent, the book in not available!');
            return redirect('/book-rent');
        } else {
            try {
                $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

                if ($count >= 3) {
                    Session::flash('status', 'danger');
                    Session::flash('message', 'Cannot rent, user has reach limit rent book!');
                    return redirect('/book-rent');
                } else {
                    DB::beginTransaction();
                    // process insert to rent table
                    RentLogs::create($request->all());
                    // process update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not stock';
                    $book->save();
                    DB::commit();
                    
                    Session::flash('status', 'success');
                    Session::flash('message', 'Rent Book Success!');
                    return redirect('/book-rent');
                }

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }
    public function returnBook()
    {
        
        $users = User::where('role_id', '!=', '1')->where('status', 'active')->get();
        $books = Book::where('status', 'not stock')->get();
        return view('book-return', ['users' => $users, 'books' => $books]);
    }
    public function saveReturnBook(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData == 1) {
            //return berhasil
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();
            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();
            Session::flash('status', 'success');
            Session::flash('message', 'The Book is returned successsfuly!');
            return redirect('/book-return');
        }else {
            //error notice
            Session::flash('status', 'danger');
            Session::flash('message', 'Error Return Book!');
            return redirect('/book-return');
        }
    }
}
