<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function store(Request $request)
    {
        $book = Book::create($this->validateRequest($request));

        return $book->show();
    }

    public function update(Book $book, Request $request)
    {
        $book->update($this->validateRequest($request));

        return $book->show();
    }

    public function destroy(Book $book,Request $request)
    {
        $book->delete();

        return $book->index();
    }

    /*
     *
     * protected functions */


    protected function validateRequest($request)
    {
        $validate_rules = [
            'title' => 'required',
            'author' => 'required'
        ];

        return $request->validate($validate_rules);

    }

}
