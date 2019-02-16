<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function index()
    {

        $blogPosts = BlogPost::all();

        return view('blog-posts.index', compact('blogPosts'));
    }
}
