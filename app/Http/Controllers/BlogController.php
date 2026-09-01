<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Blog Listing
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        // Main query
        $query = Blog::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category')) {

            $query->where(
                'category',
                $request->category
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Blogs
        |--------------------------------------------------------------------------
        */
        $blogs = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Featured Blog
        |--------------------------------------------------------------------------
        |
        | Latest blog ko featured article bana rahe hain.
        | Search ya category filter hone par featured blog nahi dikhayenge.
        |
        */
        $featuredBlog = null;

        if (
            !$request->filled('search') &&
            !$request->filled('category')
        ) {
            $featuredBlog = Blog::latest()->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        $categories = Blog::whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        /*
        |--------------------------------------------------------------------------
        | Return Blog Index
        |--------------------------------------------------------------------------
        */
        return view(
            'blogs.index',
            compact(
                'blogs',
                'featuredBlog',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Single Blog
    |--------------------------------------------------------------------------
    */
    public function show(Blog $blog)
    {
        /*
        |--------------------------------------------------------------------------
        | Related Blogs
        |--------------------------------------------------------------------------
        |
        | Pehle same category ke blogs lenge.
        | Current blog ko list se exclude karenge.
        |
        */
        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->latest()
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | If Same Category Blogs Are Less Than 3
        |--------------------------------------------------------------------------
        |
        | Agar same category mein 3 blogs nahi hain,
        | to doosri categories ke latest blogs se list complete kar denge.
        |
        */
        if ($relatedBlogs->count() < 3) {

            $remaining = 3 - $relatedBlogs->count();

            $additionalBlogs = Blog::where('id', '!=', $blog->id)
                ->whereNotIn(
                    'id',
                    $relatedBlogs->pluck('id')
                )
                ->latest()
                ->take($remaining)
                ->get();

            $relatedBlogs = $relatedBlogs->concat($additionalBlogs);
        }

        /*
        |--------------------------------------------------------------------------
        | Return Single Blog Page
        |--------------------------------------------------------------------------
        */
        return view(
            'blogs.show',
            compact(
                'blog',
                'relatedBlogs'
            )
        );
    }
}