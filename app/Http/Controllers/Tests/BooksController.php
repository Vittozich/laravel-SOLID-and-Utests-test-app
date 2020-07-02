<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function store(Request $request)
    {
        Book::create($this->validateRequest($request));
    }

    public function update(Book $book, Request $request)
    {
        $book->update($this->validateRequest($request));
    }

    protected function validateRequest($request)
    {
        $validate_rules = [
            'title' => 'required',
            'author' => 'required'
        ];

        return $request->validate($validate_rules);

    }
}
