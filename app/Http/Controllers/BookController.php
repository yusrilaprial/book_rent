<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('book', ['books' => $books]);
    }
    public function add()
    {
        $categories = Category::all();
        return view('book-add', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'image' => 'file|max:1000'
        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        Session::flash('status', 'success');
        Session::flash('message', 'Add book success!');
        return redirect('/books');
    }
    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book-edit', ['book' => $book, 'categories' => $categories]);
    }
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'book_code' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => 'file|max:1000'
        ]);

        $book = Book::where('slug', $slug)->first();

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
            Storage::disk('public')->delete('cover/'.$book->cover);
        }

        $book->slug = null;
        $book->update($request->all());
        
        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }
        
        Session::flash('status', 'success');
        Session::flash('message', 'Edit book success!');
        return redirect('/books');
    }
    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book-delete', ['book' => $book]);
    }
    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        Session::flash('status', 'danger');
        Session::flash('message', 'Delete book success!');
        return redirect('/books');
    }
    public function deletedBook()
    {
        $deletedBook = Book::onlyTrashed()->get();
        return view('book-deleted-list', ['deletedBook' => $deletedBook]);
    }
    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Restore book success!');
        return redirect('/books');
    }
}
