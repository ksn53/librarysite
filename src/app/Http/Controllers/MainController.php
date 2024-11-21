<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $books = \Cache::tags(['books'])->remember('admin_book_list', 3600, function(){
                return Book::whereOwnerId(Auth::id())->latest()->paginate(5);
            });
        }
        return view ('main', !empty($books) ? compact('books') : []);
    }
}
