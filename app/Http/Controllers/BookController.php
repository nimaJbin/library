<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function store()
    {
        Book::create($this->getValidate());
    }

    public function update(Book $book)
    {
        $book->update($this->getValidate());
    }


    public function getValidate(): array
    {
        return \request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
