<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request){
        // TODO: Validation

        Book::create([
            'title' => $request->title,
            'author' => $request->author
        ]);
    }
}
