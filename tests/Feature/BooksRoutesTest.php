<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function a_book_can_added_to_database()
    {

        $response = $this->post('/books', [
            'title' => 'something',
            'author' => 'Viktor'
        ]);

        $response->assertStatus(200);

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_and_author_are_required()
    {
        $this->withExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Viktor'
        ]);

        $response->assertSessionHasErrors('title');

        $response = $this->post('/books', [
            'title' => '123',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');

    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->post('/books', [
            'title' => '123',
            'author' => '321'
        ]);

        $book_id = Book::first()->id;

        $response = $this->put('/books/'.$book_id, [
            'title' => 'new_one',
            'author' => 'new_onea_a'
        ]);

        $this->assertEquals('new_one',Book::first()->title);
        $this->assertEquals('new_onea_a',Book::first()->author);

    }
}
