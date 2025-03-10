<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
       
        return response()->json(Blog::all(), 200);
    }

    public function store(Request $request)
    {
        dd("jhsjhdj");
        $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'job' => 'required'
        ]);

        $blog = Blog::create($request->all());

        return response()->json(['message' => 'Blog created successfully', 'blog' => $blog], 201);
    }

    public function show(Blog $blog)
    {
        return response()->json($blog->load('detail'), 200);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'job' => 'required',
            'description' => 'nullable|string',
            'category' => 'nullable|string'
        ]);

        $blog->update($request->only(['name', 'salary', 'job']));

        if ($blog->detail) {
            $blog->detail()->update([
                'description' => $request->description,
                'category' => $request->category
            ]);
        } else {
            $blog->detail()->create([
                'description' => $request->description,
                'category' => $request->category
            ]);
        }

        return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog->load('detail')], 200);
    }


    public function destroy(Blog $blog)
    {
        $blog->detail()->delete(); // Soft delete BlogDetail
        $blog->delete(); // Soft delete Blog
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }


    public function trashed()
    {
        dd("jj");
        return response()->json(Blog::onlyTrashed()->get(), 200);
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        if ($blog->detail()->onlyTrashed()->exists()) {
            $blog->detail()->restore();
        }

        return response()->json(['message' => 'Blog restored successfully', 'blog' => $blog->load('detail')], 200);
    }


    public function forceDelete($id)
    {   
        $blog = Blog::onlyTrashed()->findOrFail($id);
    
        if ($blog->detail()->onlyTrashed()->exists()) {
            $blog->detail()->forceDelete();
        }

        $blog->forceDelete();
        return response()->json(['message' => 'Blog permanently deleted'], 200);
    }
    public function getUserBlog($userId)
    {
        $user = User::with('blog')->findOrFail($userId);
        return response()->json($user, 200);
    }

}
