<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'nima'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'nima'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'ali',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_update()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'nima'
        ]);

        $book = Book::first();

        $response = $this->patch( '/books/' . $book->id ,[
           'title' => 'new title',
           'author' => 'new author'
        ]);

        $this->assertEquals('new title', Book::first()->title);
        $this->assertEquals('new author', Book::first()->author);
    }


}
