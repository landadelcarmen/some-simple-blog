<?php

namespace Tests\Unit;

use App\BlogCategory;
use App\BlogPost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostBlogCategoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_blog_post_may_belong_to_a_category()
    {
        $blogPost = factory(BlogPost::class)->create();

        $category = factory(BlogCategory::class)->create();

        $blogPost->categories()->sync($category);

        $this->assertCount(1, $blogPost->categories);
    }

    /**
     * @test
     */
    public function a_blog_post_may_belong_to_several_categories()
    {
        $blogPost = factory(BlogPost::class)->create();

        $categories = factory(BlogCategory::class, 2)->create();

        $blogPost->categories()->sync($categories);

        $this->assertCount(2, $blogPost->categories);
    }
}
