<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request){
        
        $data = $this->validateBook($request);
        Book::create($data);
    }

    public function update(Request $request, Book $book){
        $data = $this->validateBook($request);
        $book->update($data);
    }

    public function destroy(Book $book){
        $book->delete();
    }

    protected function validateBook($request){
        return $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

    }
}
