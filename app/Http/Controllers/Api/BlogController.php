<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(20);
        return response()->json($blogs);
    }

    public function delete($slug)
    {
        Blog::where('slug', $slug)->delete();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Deleted SuccessFully !'
        ]);
    }

    public function blogCount()
    {
        $countBlog = Blog::count();
        return $countBlog;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs|max:191',
            'content' => 'required',
            'status' => 'required',
//            'featured_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filename->move(storage_path('/uploads/' . $filename));

        } else {
            $filename = '';
        }

        Blog::create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'featured_image' => $filename,
        ]);
        return \response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Created SuccessFully !'
        ]);
    }
}
