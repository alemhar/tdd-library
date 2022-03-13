<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request){
        
        $data = $this->validateBook($request);
        $book = Book::create($data);

        return redirect($book->path());
    }

    public function update(Request $request, Book $book){
        $data = $this->validateBook($request);
        $book->update($data);
        return redirect($book->path());
    }

    public function destroy(Book $book){
        $book->delete();
        return redirect('/books');
    }

    protected function validateBook($request){
        return $request->validate([
            'title' => 'required',
            'author_id' => 'required'
        ]);

    }
}
