<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookRequestValidate;

class Books extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('can:update,book')->except(['show', 'store', 'create']);
    }

    public function create()
    {
        return view ('bookAdd');
    }

    public function edit(Book $book)
    {
        return view ('bookEdit', compact('book'));
    }

    public function store(BookRequestValidate $request)
    {
        $validated = $request->validated();
        $validated['owner_id'] = Auth::id();
        $validated['category_id'] = Category::firstOrCreate(['name' => $validated['category']])->id;
        unset($validated['category']);
        if (!empty($request->image)) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = '/storage/' . $path;
        }
        Book::create($validated);
        flash('Added successfully');
        return redirect(route('admin.book.list'));
    }

    public function update(Book $book, BookRequestValidate $request)
    {
        $validated = $request->validated();
        $validated['category_id'] = Category::firstOrCreate(['name' => $validated['category']])->id;
        unset($validated['category']);
        if (!empty($request->image)) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = '/storage/' . $path;
            $book->deleteImage();
        }
        $book->update($validated);
        flash('Updated successfully');
        return redirect(route('admin.book.list'));
    }

    public function show(Book $book)
    {
        return view ('book', compact('book'));
    }

    public function destroy(Book $book, Request $request)
    {
        $book->deleteImage();
        $book->delete();
        flash('The book is deleted', 'warning');
        return redirect(route('admin.book.list'));
    }
}
