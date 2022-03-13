<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){

        $this->withoutExceptionHandling();
        
        $response = $this->post('/books',$this->data());

        $book = Book::first();
        
        $this->assertCount(1, Book::all());

        // $response->assertOk();
        $response->assertRedirect($book->path()); 
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
            'author_id' => ''
        ]);

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();

        $this->post('/books', $this->data());

        $book = Book::first();

        $response = $this->patch($book->path(), [
            'title' => 'New First Book',
            'author_id' => 2
        ]);

        $this->assertEquals('New First Book', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);

        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted(){
        $this->withoutExceptionHandling();
        $this->post('/books', $this->data());

        $this->assertCount(1, Book::all());
        $book = Book::first();

        $response = $this->delete($book->path());
        
        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');

    }

    /** @test */
    public function add_new_author_automatically(){
        $this->withoutExceptionHandling();

        $this->post('/books', $this->data());

        $book = Book::first();
        $author = Author::first();
        // dd($author);
        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());
    }

    private function data(){
        return [
            'title' => 'First Book',
            'author_id' => 1
        ];
    }
}
