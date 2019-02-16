<?php

namespace Tests\Feature;

use App\BlogPost;
use Illuminate\Support\Collection;
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

        $blogPosts->assertEquals($response->data('blogPosts'));
    }

    /**
     * @test
     */
    public function blog_posts_are_listed_in_reverse_chronological_order()
    {

        $blogPostA = factory(BlogPost::class)->create([ 'created_at' => now()->subDays(2) ]);
        $blogPostB = factory(BlogPost::class)->create([ 'created_at' => now() ]);
        $blogPostC = factory(BlogPost::class)->create([ 'created_at' => now()->subDays(5) ]);

        $response = $this->get('/admin/blog/posts');

        $response->assertSuccessful();

        $this->assertCount(3, $response->data('blogPosts'));
        $this->assertTrue($response->data('blogPosts')[0]->is($blogPostB));
        $this->assertTrue($response->data('blogPosts')[1]->is($blogPostA));
        $this->assertTrue($response->data('blogPosts')[2]->is($blogPostC));
    }
}
