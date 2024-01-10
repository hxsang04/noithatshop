<?php

namespace App\Http\Controllers\BackEnd;

use App\Blog;
use App\CategoryBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Blog::join('category_blogs','category_blogs.category_blog_id','blogs.category_blog_id')->orderBy('blog_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->blog_id.'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->blog_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->addColumn('image', function($data){
                    return '<img src="'.url('uploads/blog/'.$data->blog_image).'" width="80px" height="80px" class="img-thumbnail" />';
                })

                ->rawColumns(['action','image'])
                ->make(true);
        }
        $title = 'Blogs';
        $category = CategoryBlog::all();
        return view('Admin.M_Blog', compact('title','category'));
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
        if(request()->ajax()){
            $blog = new Blog();
            $blog->blog_name = $request->blog_name;
            $blog->category_blog_id  = $request->category_blog_id;
            $blog->user_id  = Auth::id();
            $blog->blog_content = $request->blog_content;
            $blog->blog_desc = $request->blog_desc;
            $blog->blog_view = 0;
            $blog->blog_status = $request->blog_status;


            if ($request->file('blog_image')) {
                $image = $request->file('blog_image');
                $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(750, 375);
                $image_resize->save(public_path('uploads/blog/' .$name));

                $blog->blog_image = $name;
            }

            $blog->save();

            return response()->json([
                'status'=>200,
                'message'=>'Add Successfully'
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sample = Blog::findOrfail($id);
        if($sample){

            return response()->json([
                'status'=>200,
                'data'=>$sample
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if(request()->ajax()){
            $blog = Blog::findOrfail($id);
            if($blog){
                $blog->blog_name = $request->blog_name;
                $blog->category_blog_id  = $request->category_blog_id ;
                $blog->blog_content = $request->blog_content;
                $blog->blog_desc = $request->blog_desc;
                $blog->blog_status = $request->blog_status;


                if ($request->file('blog_image')) {
                    if(File::exists(public_path('uploads/blog/').$blog->blog_image)){
                        unlink(public_path('uploads/blog/').$blog->blog_image);
                    }
                    $image = $request->file('blog_image');
                    $name = uniqid().'_'.time().'_'.$image->getClientOriginalName();

                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(750, 375);
                    $image_resize->save(public_path('uploads/blog/' .$name));

                    $blog->blog_image = $name;
                }

                $blog->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Add Successfully'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Data Not Found'
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sample = Blog::findOrfail($id);
        if($sample){
            if(File::exists(public_path('uploads/blog/').$sample->blog_image)){
                unlink(public_path('uploads/blog/').$sample->blog_image);
            }
            $sample->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
            ]);
        }
    }
}
