<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
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
}
