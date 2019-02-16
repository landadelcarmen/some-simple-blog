<?php

namespace Tests\Unit;

use App\BlogPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_a_title()
    {
        $blogPost = factory(BlogPost::class)->create(['title' => 'lorem ipsum']);

        $this->assertDatabaseHas('blog_posts', ['title' => $blogPost->title]);
    }
}
