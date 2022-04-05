<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function  __construct()
    {
        $this->middleware('admin')->only(['index','changeStatus','saleshistory']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::with('product:id,name,price')
            ->with('user:id,firstname,lastname,phone')
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('order.index', compact('orders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {

        $validated = $request->validated();
        $validated["status"] = "pending";
        $validated["total"] = $validated["quantity"] * $validated["price"] + 50;
        Order::create($validated);
        return redirect()->route('order.my-orders')->with('success', 'Order Placed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myOrders(Request $request)
    {
        if($request->query('status'))
        {
            $orders = Order::with('product:id,name,price,image')
                ->where('status', $request->query('status'))
                ->where('user_id', auth()->user()->id)
                ->orderBy('updated_at','desc')
                ->get();
            return response()->json($orders);
        }
        else
        {
            $orders = Order::with('product:id,name,price,image')
                ->with('user:id,firstname,lastname,phone')
                ->where('user_id', auth()->user()->id)
                ->orderBy('updated_at','desc')
            ->get();
        }

        return view('order.show')->with('orders', $orders);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $validated = $request->validated();
        $validated["total"] = $validated["quantity"] * $validated["price"] + 50;
        $order->update($validated);
        return redirect()->route('order.my-orders')->with('success', 'Order Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder(Order $order)
    {
        $order->cancelOrder();
        return redirect()->route('order.my-orders')->with('success', 'Order Cancelled Successfully');
    }

    public function changeOrderStatus(Order $order)
    {
        $order->changeOrderStatus();
        return redirect()->route('order.index')->with('success', 'Order Status Changed Successfully');
    }

    public function history()
    {
        $orders = Order::with('product:id,name,price,image')
                        ->where('user_id', auth()->user()->id)
                        ->where('status', '=', 'completed')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('order.history', compact('orders'));
    }

    public function salesHistory()
    {
        $orders = Order::with('product:id,name,image')
                        ->with('user:id,firstname,lastname,phone')
                        ->where('status', '=', 'completed')
                        ->orderBy('created_at','desc')
                        ->paginate(2);

        $stats = Order::get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->monthName;
            });

        foreach ($stats as $key => $value) {
            $stats[$key] = $value->sum('total');
        }
        return view('order.salehistory', compact('orders','stats'));
    }

}
