<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function index()
    {

        $blogPosts = BlogPost::latest()->get();

        return view('blog-posts.index', compact('blogPosts'));
    }
}
