<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Order;

class OrderController extends Controller
{

    public function index()
    {
        $orders= Order::all();
        return response()->json($orders);
    }

    public function create()
    {
        return view('user::orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100|min:5',
            'description' => 'required|max:250|min:10',
        ]);

        Order::create(array_merge($request->only('title', 'description'), ['user_id' => auth()->id()]));

        return redirect()->to('/user/orders')->with('message', 'Order created successfully!');
    }

    public function show($id)
    {
        return view('user::orders.show');
    }

    public function edit(Order $order)
    {
        return view('user::orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'title' => 'required|max:100|min:5',
            'description' => 'required|max:250|min:10',
        ]);

        $order->update($request->all());

        return redirect()->to('/user/orders')->with('message', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->to('/user/orders')->with('message', 'Order deleted successfully');
    }
}
