<?php

namespace App\Http\Controllers\FrontEnd;

use App\Blog;
use App\CategoryBlog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->category = CategoryBlog::limit(6)->inRandomOrder()->get();
        $this->blogs_view = Blog::where('blog_status',1)->orderby('blog_view','desc')->limit(3)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('blog_status',1)->orderby('blog_id','desc')->paginate(5);
        $blogs_view = $this->blogs_view;
        $categories = $this->category;

        return view('User.blog', compact('blogs','categories','blogs_view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($_GET['type']);
        $blogs_view = $this->blogs_view;
        $categories = $this->category;
        $blog->blog_view = $blog->blog_view + 1;
        $blog->save();

        $prev = Blog::find($_GET['type'] - 1);
        $next = Blog::find($_GET['type'] + 1);


        return view('User.detail_blog', compact('blog','categories','blogs_view', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = CategoryBlog::find($id);
        $blogs = Blog::where([['blog_status',1],['category_blog_id',$cate->category_blog_id]])->orderby('blog_id','desc')->paginate(5);
        $blogs_view = $this->blogs_view;
        $categories = $this->category;

        return view('User.blog', compact('blogs','categories','blogs_view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
