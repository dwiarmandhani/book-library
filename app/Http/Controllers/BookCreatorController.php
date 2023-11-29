<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCreator;

class BookCreatorController extends Controller
{
    public function index()
    {
        $creators = BookCreator::all();
        return view('bookcreators.index', compact('creators'));
    }

    public function create()
    {
        return view('bookcreators.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // tambahkan validasi sesuai kebutuhan lainnya
        ]);

        if (BookCreator::create($validatedData)) {
            return redirect()->route('bookcreators.index')->with('success', 'Pencipta buku berhasil ditambahkan');
        } else {
            return redirect()->route('bookcreators.index')->with('failed', 'Pencipta buku gagal ditambahkan');
        }
    }

    public function edit($creatorId)
    {
        $creator = BookCreator::getById($creatorId);

        return view('bookcreators.edit', compact('creator'));
    }

    public function update(Request $request, $creatorId)
    {
        $creator = BookCreator::find($creatorId);

        if (!$creator) {
            return redirect()->route('bookcreators.index')->with('error', 'Pencipta buku tidak ditemukan');
        }
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        if ($creator->update($validatedData)) {
            return redirect()->route('bookcreators.index')->with('success', 'Informasi pencipta buku berhasil diperbarui');
        } else {
            return redirect()->route('bookcreators.index')->with('failed', 'Informasi pencipta buku gagal diperbarui');
        }
    }


    public function destroy($creatorId)
    {
        $creator = BookCreator::find($creatorId);

        if (!$creator) {
            return redirect()->route('bookcreators.index')->with('error', 'Pencipta buku tidak ditemukan');
        }
        if ($creator->delete()) {
            return redirect()->route('bookcreators.index')->with('success', 'Pencipta buku berhasil dihapus');
        } else {
            return redirect()->route('bookcreators.index')->with('failed', 'Pencipta buku berhasil dihapus');
        }
    }
}
