<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request){
        
        $data = $this->validateBook($request);
        // $data = $request->validate([
        //     'title' => 'required',
        //     'author' => 'required'
        // ]);

        Book::create($data);
    }

    public function update(Request $request, Book $book){
        $data = $this->validateBook($request);
        
        $book->update($data);
    }

    protected function validateBook($request){
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

        return $data;
    }
}
