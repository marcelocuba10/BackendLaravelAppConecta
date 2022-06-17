<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Ground;

class GroundApiController extends Controller
{
    public function index()
    {
        $grounds= Ground::all();
        return response()->json($grounds);
    }

    public function edit($id)
    {

        $ground = Ground::find($id);
        
        return response()->json($ground);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'title'=> 'required',
            'description'=>'required',
            'categoryId' =>'required',
            'date'=>'nullable',
            'status'=>'required',
            'userId'=>'nullable',
            'address'=>'nullable'
        ]);

        //save to DB
        $order = Ground::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'categoryId'=>$request->categoryId,
            'date'=>$request->date,
            'status'=>$request->status,
            //'userId'=>$request->userId,
            //'address'=>$request->address,
        ]);

        //return response
        return response()->json($order);
        
    }

    public function update(Request $request , Ground $order){
        //validation
        $request->validate([
            'title'=> 'required',
            'description'=>'required',
            'categoryId' =>'required',
            'date'=>'nullable',
            'status'=>'required',
            'userId'=>'nullable',
            'address'=>'nullable'
        ]);

        //save to DB
        $order->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'categoryId'=>$request->categoryId,
            'date'=>$request->date,
            'status'=>$request->status,
            'userId'=>$request->userId,
            'address'=>$request->address,
        ]);

        //return response
        return response()->json($order);
        
    }

    public function destroy(Ground $order){
        $order->delete();
        return response()->json($order);
    }
}
