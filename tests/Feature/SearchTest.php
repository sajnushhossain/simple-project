<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_can_search_posts_by_title()
    {
        $user = User::factory()->create();
        $post1 = Post::factory()->create(['title' => 'This is a post about Laravel']);
        $post2 = Post::factory()->create(['title' => 'This is a post about PHP']);

        $response = $this->get(route('search', ['query' => 'Laravel']));

        $response->assertStatus(200);
    }

    // /** @test */
    // public function test_it_can_search_posts_by_category()
    // {
    //     $user = User::factory()->create();
    //     $category1 = Category::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    //     $category2 = Category::factory()->create(['name' => 'PHP', 'slug' => 'php']);
    //     $post1 = Post::factory()->create(['category_id' => $category1->id]);
    //     $post2 = Post::factory()->create(['category_id' => $category2->id]);

    //     $response = $this->get(route('search', ['category' => 'laravel']));

    //     $response->assertStatus(200);
    //     $response->assertSee($post1->title);
    //     $response->assertDontSee($post2->title);
    // }

    // /** @test */
    // public function test_it_can_search_posts_by_date()
    // {
    //     $user = User::factory()->create();
    //     $post1 = Post::factory()->create(['created_at' => now()->subDay()]);
    //     $post2 = Post::factory()->create(['created_at' => now()->subDays(2)]);

    //     $response = $this->get(route('search', ['date' => now()->subDay()->toDateString()]));

    //     $response->assertStatus(200);
    //     $response->assertSee($post1->title);
    //     $response->assertDontSee($post2->title);
    // }
}
