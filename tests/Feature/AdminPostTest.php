<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class AdminPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_create_a_post_with_an_image()
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('public');

        $this->post(route('admin.posts.store'), [
            'title' => 'New Post',
            'body' => 'This is the body',
            'category_id' => 1,
            'image' => UploadedFile::fake()->image('post.jpg')
        ]);

        $this->assertDatabaseHas('posts', ['title' => 'New Post']);
        Storage::disk('public')->assertExists('images/post.jpg');
    }
}
