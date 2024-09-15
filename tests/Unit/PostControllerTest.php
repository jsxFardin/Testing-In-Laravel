<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_new_post()
    {
        // Fake the request data
        $postData = [
            'title' => 'Test Post Title',
            'body' => 'Test Post Body',
            'slug' => 'test-post-slug',
        ];

        // Send the POST request to store the post
        $response = $this->postJson('http://127.0.0.1:8000/posts', $postData);

        // Assert the response status is 201 Created
        $response->assertStatus(201);

        // Assert the JSON response contains the expected result
        $response->assertJson(['result' => 'ok']);

        // Assert the database has the post stored
        $this->assertDatabaseHas('posts', [
            'title' => $postData['title'],
            'body' => $postData['body'],
            'slug' => $postData['slug'],
        ]);
    }
}
