<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view ('admin.main', []);
    }

    public function booklist()
    {
        $books = \Cache::tags(['books'])->remember('admin_book_list', 3600, function(){
            return Book::whereOwnerId(Auth::id())->latest()->paginate(10);
        });
        return view ('admin.booklist', compact('books'));
    }
}
