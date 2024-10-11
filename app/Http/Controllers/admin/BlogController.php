<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //     index
    // show
    // store
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    public function store(Request $request) 
    {
    //    $request->validate([
    //     'title' => 'required',
    //     'subtitle' => 'required',
    //     'category_id' => 'required'
    //    ]);
        
       $blog = Blog::create([
             'title'=> $request->title,
             'subtitle'=> $request->subtitle,
             'slug'=> Str::slug($request->title, '-'),
             'description'=> $request->description,
             'priority' => $request->priority ?? rand(20, 200),
             'category_id' => $request->category_id,
        ]);

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('blog', 'public');
                 $proImage = new BlogImage();
                   $proImage->image = $path;
                   $proImage->blog_id = $blog->id;
                   $proImage->save();
            }
         }

        return response()->json("blog Create Success");
    }

    public function show($id)
    {
        $blog = Blog::with('blogImage')->find($id);
        return response()->json(['blog' => $blog]);
    }

    public function update(BlogRequest $request, $id) 
    {
    //    $request->validate([
    //     'title' => 'required',
    //     'subtitle' => 'required',
    //     'category_id' => 'required'
    //    ]);

       $blog = Blog::find($id);
        
       $blog->update([
             'title'=> $request->title,
             'subtitle'=> $request->subtitle,
             'slug'=> Str::slug($request->title, '-'),
             'description'=> $request->description,
             'priority' => $request->priority ?? rand(20, 200),
             'category_id' => $request->category_id,
        ]);

        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $path = $image->store('blog', 'public');
                 $proImage = new BlogImage();
                   $proImage->image = $path;
                   $proImage->blog_id = $blog->id;
                   $proImage->save();
            }
         }

        return response()->json("blog Update Success");
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
       return response()->json(["success"=> true]);
    }
}
