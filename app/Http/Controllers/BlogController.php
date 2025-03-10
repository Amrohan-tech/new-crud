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
        return response()->json($blog, 200);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'salary' => 'required|numeric',
            'job' => 'required'
        ]);

        $blog->update($request->all());

        return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog], 200);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }

    public function trashed()
    {
        return response()->json(Blog::onlyTrashed()->get(), 200);
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return response()->json(['message' => 'Blog restored successfully', 'blog' => $blog], 200);
    }

    public function forceDelete($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->forceDelete();
        return response()->json(['message' => 'Blog permanently deleted'], 200);
    }
}

