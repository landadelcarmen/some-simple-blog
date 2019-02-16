<?php

namespace Tests\Unit;

use App\BlogCategory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCategoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_a_title()
    {
        factory(BlogCategory::class)->create(['title' => 'lorem ipsum']);

        $this->assertDatabaseHas('blog_categories', ['title' => 'lorem ipsum']);
    }
}
