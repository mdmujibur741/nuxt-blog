<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //         $this->middleware(['permission:menus list'])->only('index');
    //         $this->middleware(['permission:menus create'])->only('create');
    //         $this->middleware(['permission:menus edit'])->only('edit');
    //         $this->middleware(['permission:menus show'])->only('show');
    //         $this->middleware(['permission:menus delete'])->only('destroy');
    // } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        return response()->json($categories);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $data = $request->validate([
            'title' => 'required',
        ]);
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title, '-');
        $data['subtitle'] = $request->post('subtitle');
        $data['details'] = $request->post('details');
        $data['image'] = $request->post('image');
        $data['priority'] = $request->post('priority');
        $data['is_home_show'] = $request->is_home_show ? 1 : 0 ;
        $data['meta_title'] = $request->meta_title;
        $data['meta_description'] = $request->meta_description ;
        $data['is_popular'] = $request->is_popular ? 1 : 0 ;
        $data['status'] = $request->status ? 1 :0 ;
        $category = Category::create($data);

        return response()->json(["success"=> true, 'category' => $category]);

    }

    public function show($id)
    {
         $category = Category::find($id);
        $data['page'] = "Edit Menu";

        return response()->json(["success"=> true, 'category' => $category]);
    }

  
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'title' => 'required',
        ]);
        
        $category = Category::find($id);

        $data['title'] = $request->post('title');
        $data['subtitle'] = $request->post('subtitle');
        $data['details'] = $request->post('details');
        $data['priority'] = $request->post('priority');
        $data['is_home_show'] = $request->is_home_show ? 1 : 0 ;
        $data['meta_title'] = $request->meta_title;
        $data['meta_description'] = $request->meta_description ;
        $data['is_popular'] = $request->is_popular ? 1 : 0 ;
        $data['status'] = $request->status ? 1 :0 ;
        $data['image'] = $request->post('image');

        $category->update($data);
        return response()->json(["success"=> true]);
    }

  
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
       return response()->json(["success"=> true]);
    }






}
