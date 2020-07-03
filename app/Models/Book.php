<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author'
    ];


    /*redirects helpers*/
    public function show()
    {
        return redirect()->route('books.show',$this->id);
    }

    public function index()
    {
        return redirect()->route('books.index');
    }

}
