<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function index()
    {

        $blogPosts = BlogPost::latest()->get()->each( function ($blogPost) {
            return $blogPost->body = str_limit($blogPost->body);
        });

        return view('blog-posts.index', compact('blogPosts'));
    }
}
