<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created(){
        $this->withoutExceptionHandling();  
        $response = $this->post('/authors',[
            'name' => 'Alemhar',
            'dob' => '01/10/1974'
        ]);

        $response->assertOk();

        $author = Author::all();

        $this->assertCount(1,$author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1974/10/01', $author->first()->dob->format('Y/d/m'));
    }
}
