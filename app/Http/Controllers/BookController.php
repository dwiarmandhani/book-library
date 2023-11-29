<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCreator;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Ambil daftar pencipta buku untuk dropdown/select
        $creators = BookCreator::all();
        return view('books.create', compact('creators'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'book_creator_id' => 'required|exists:book_creators,id',
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'book_creator_id' => 'required|exists:book_creators,id'
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        }

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }
    public function edit(Book $book)
    {
        $creators = BookCreator::all();
        return view('books.edit', compact('book', 'creators'));
    }
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'book_creator_id' => 'required|exists:book_creators,id',
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'book_creator_id' => 'required|exists:book_creators,id',
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        // Periksa apakah ada file gambar baru diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        } else {
            // Jika tidak ada file gambar baru, gunakan gambar yang sudah ada
            $validatedData['image'] = $book->image;
        }

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Informasi buku berhasil diperbarui');
    }
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
