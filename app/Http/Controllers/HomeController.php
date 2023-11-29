<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = DB::table('books')
            ->select('books.id', 'books.title', 'books.image', 'book_creators.name AS creator_name')
            ->join('book_creators', 'books.book_creator_id', '=', 'book_creators.id')
            ->get();
        return view('home', compact('books'));
    }
}
