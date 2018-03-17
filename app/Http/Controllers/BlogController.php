<?php namespace App\Http\Controllers;

use App\Blog\Blog;

class BlogController extends Controller
{
    public function index(Blog $blog)
    {
        $posts = $blog->all();

        return view('blog')->with(compact('posts'));
    }

    public function show(Blog $blog, $slug)
    {
        $post = $blog->post($slug);

        return view('blog-post')->with(compact('post'));
    }
}
