<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthorController extends Controller
{
    public function store(Request $request){
        Author::create($request->only([
            'name',
            'dob'
        ]));
    }
}
