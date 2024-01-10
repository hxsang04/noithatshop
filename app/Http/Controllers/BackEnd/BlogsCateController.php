<?php

namespace App\Http\Controllers\BackEnd;

use App\CategoryBlog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(CategoryBlog::orderBy('category_blog_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->category_blog_id.'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->category_blog_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Category Blogs';
        return view('Admin.M_BlogCate', compact('title'));
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
            $category = new CategoryBlog();
            $category->category_blog_name = $request->cate_name;

            $category->save();

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
        $sample = CategoryBlog::findOrfail($id);
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
            $category = CategoryBlog::findOrfail($id);
            if($category){
                $category->category_blog_name = $request->cate_name;
                $category->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Update Successfully'
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
        $sample = CategoryBlog::findOrfail($id);
        if($sample){
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
