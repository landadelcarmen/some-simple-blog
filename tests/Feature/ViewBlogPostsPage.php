<?php

namespace Tests\Feature;

use App\BlogCategory;
use App\BlogPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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

    /**
     * @test
     */
    public function blog_posts_titles_are_shown()
    {
        factory(BlogPost::class)->create(['title' => 'title']);

        $response = $this->get('/admin/blog/posts');

        $response->assertSuccessful()
                 ->assertSee('title');
    }

    /**
     * @test
     */
    public function blog_posts_body_excerpt_are_shown()
    {
        $blogPost = factory(BlogPost::class)->create([ 'body' => str_random(130) ]);

        $response = $this->get('/admin/blog/posts');

        $response->assertSuccessful()
                ->assertSee(Str::limit($blogPost->body, 100, '...'));

        $this->assertTrue($response->data('blogPosts')[0]->body <= 103);
    }

    /**
     * @test
     */
    public function blog_posts_categories_are_shown()
    {
        $blogPost = factory(BlogPost::class)->create();

        $category = factory(BlogCategory::class)->create(['title' => 'lorem ipsum']);

        $blogPost->categories()->sync($category);

        $response = $this->get('/admin/blog/posts');

        $response->assertSuccessful()
                 ->assertSee($category->title);

    }
}
