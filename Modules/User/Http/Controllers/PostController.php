<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        
        $posts = Post::paginate(3);

        if ($request->ajax()) {
            $view = view('user::posts.data', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }
        return view('user::posts.index', compact('posts'));
    }

    public function search(Request $request)
    {

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
