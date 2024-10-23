<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function home() 
    {
        $latestPost= Blog::orderBy('id', 'desc')->take(3)->get();
        $popularPost= Blog::orderBy('id', 'asc')->take(6)->get();

        $category = Category::all();

        $category->map(function ($data) {
          $id = $data['id'];
          $data['blogs']  = Blog::where('category_id', $id)->get();
    });  
    return response()->json(['latestPost'=> $latestPost, 'popularPost' => $popularPost, 'category'=> $category ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $blogs = Blog::where('category_id', $category->id)->paginate(9);
        return response()->json(['blogs'=> $blogs ]);
    }

    public function latestBlog($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $relatedCategory = Category::all();
        $latestBlog = Blog::where('category_id', $category->id)->orderBy('id', 'desc')->take(3)->get();
        return response()->json(['category'=> $category , 'latestBlog' => $latestBlog, 'relatedCategory' => $relatedCategory  ]);
    }

    public function blogs()
    {
        $blogs = Blog::orderBy('priority', 'asc')->paginate(9);
        return response()->json(['blogs'=> $blogs  ]);
    }

    public function blog($slug=null)
    {
        $blog = Blog::where('slug', $slug)->first();
        $related = Blog::where('category_id', $blog->category_id)->take(6)->get();
        $trading = Blog::orderBy('priority', 'asc')->take(1)->get();
        return response()->json(['blog'=> $blog , 'related' => $related, 'trading'=> $trading ]);
    }

}
