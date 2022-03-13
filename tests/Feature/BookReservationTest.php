<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){

        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'First Book',
            'author' => 'Ali'
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required(){
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Ali'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required(){
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'First Book',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'First Book',
            'author' => 'Ali'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New First Book',
            'author' => 'Ali New'
        ]);

        $this->assertEquals('New First Book', Book::first()->title);
        $this->assertEquals('Ali New', Book::first()->author)   ;


    }
}
