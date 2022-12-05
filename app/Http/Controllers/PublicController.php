<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->category != '' && $request->title != '') {
            $books = Book::where('title', 'like', '%'.$request->title.'%')
                    ->whereHas('categories', function ($q) use ($request) {
                       $q->where('categories.id', $request->category); 
                    })->get();
        } elseif($request->category != '') {
            $books = Book::whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category); 
             })->get();
        } elseif($request->title != '') {
            $books = Book::where('title', 'like', '%'.$request->title.'%')->get();
        }
        else {
            $books = Book::all();
        }
        
        return view('book-list', ['books' => $books, 'categories' => $categories]);
    }
}
