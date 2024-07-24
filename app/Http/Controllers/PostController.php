<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PostController extends Controller
{
    //
    public function index(): View
    {
        
        // Latest posts
        $posts = Post::with('categories')
            ->where('active', '=', 1)
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function single(Post $post, Request $request)
    {
        if (!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }
        
        $next = Post::query()
            ->where('active', true)
            ->where('id', '>', $post->id)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->where('active', true)
            ->where('id', '<', $post->id)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->first();

        $post->load('seo');
        $seo = $post;
        return view('blog.single', compact('post', 'prev', 'next', 'seo'));
    }

    public function category(Category $category)
    {
        $posts = Post::query()
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('blog.index', compact('posts', 'category'));
    }
}
