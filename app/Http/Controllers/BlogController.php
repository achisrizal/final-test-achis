<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blogs = Blog::where('status', 'published')->get();

        return $this->sendResponse($blogs, 'Blogs retrieved successfully.');
    }

    public function all(Request $request)
    {
        $request->validate([
            'search' => 'string',
            'status' => 'in:draft,published,archived',
        ]);

        $blogs = Blog::query();

        if ($request->has('status')) {
            $blogs->where('status', $request->status);
        }

        if ($request->has('search')) {
            $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $blogs->get();

        return $this->sendResponse($blogs, 'Blogs retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'slug' => 'unique:blogs',
            ]);

            $request['author_id'] = Auth::user()->id;

            if (!$request->has('slug')) {
                $request['slug'] = Str::slug($request->title);

                $count = Blog::where('slug', 'like', $request->slug . '%')->count();

                if ($count > 0) {
                    $request['slug'] = $request->slug . '-' . $count;
                }
            }

            $blog = Blog::create($request->all());

            return $this->sendResponse($blog, 'Blog created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('Error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
