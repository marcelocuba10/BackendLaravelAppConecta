<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Log;
use Modules\User\Entities\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Post::where('title', 'LIKE', "%{$search}%")->get();
        return view('user::posts.results', compact('results', 'search'))->render();
    }

    public function show(Request $request)
    {
        //dd($request->all());
        $post = Post::findOrFail($request->id);
        //dd($post);
        return view('user::posts.post', compact('post'))->render();
    }

    public function index(Request $request)
    {
        $status = $request->input('status');
        $posts = Post::paginate(3);

        if ($request->ajax()) {
            $view = view('user::posts.data', compact('posts','status'))->render();
            return response()->json(['html' => $view]);
        }
        return view('user::posts.index', compact('posts','status'));
    }


    public function search_old(Request $request)
    {
        $status = $request->input('status');

        if ($request->ajax()) {
            $view = view('user::posts.data', compact('posts','status'))->render();
            return response()->json(['html' => $view]);
        }
        return view('user::posts.index', compact('posts','status'));

        $filter = $request->input('filter');
        //dd($filter);
        if (!$filter) {
            $posts = Post::paginate(3);
            return redirect()->route('posts.index', compact('posts'));
        }

        $posts = DB::table('posts')
        ->select('posts.id', 'posts.title', 'posts.body')
        ->where('posts.title', 'LIKE', "%{$filter}%")
        ->get();

        if ($request->ajax()) {
            dd($filter);
            $view = view('user::posts.data', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }
        return view('user::posts.index', compact('posts'));
    }
}
