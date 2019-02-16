<?php

namespace Tests\Feature;

use App\BlogPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBlogPostsPage extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_lists_the_blog_posts()
    {
        $blogPosts = factory(BlogPost::class, 3)->create();

        $response = $this->get('/admin/blog/posts');

        $response->assertSuccessful();

        $this->assertCount(3, $response->data('blogPosts'));

        $blogPosts->assertEquals($response->data('blogPosts'));
    }
}
