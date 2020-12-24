<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UsersOrder;
use App\Models\UsersWallet;
use Illuminate\Http\Request;

class UsersOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $userId = $request->get('userId');
        $orders = Product::find($request->get('orders'));
        $totalOrders = 0;
        foreach ($orders as $order) {
            UsersOrder::create([
                'user_id' => $userId,
                'product_id' => $order->id,
                'price' => $order->product_price,
            ]);
            $totalOrders += $order->product_price;
        }
        $wallet = UsersWallet::find($userId);
        $wallet->wallet_balance = $wallet->wallet_balance - $totalOrders;
        $wallet->save();
        if ($wallet) {
            return response()->json(['status' => 200, 'title' => 'موفقیت آمیز', 'type' => 'success', 'message' => 'عملیات با موفقیت انجام شد ']);
        } else {
            return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'ظاهرا مشکلی در خرید به وجود آمده ']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UsersOrder $usersOrder
     * @return \Illuminate\Http\Response
     */
    public function show(UsersOrder $usersOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UsersOrder $usersOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersOrder $usersOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UsersOrder $usersOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersOrder $usersOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UsersOrder $usersOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersOrder $usersOrder)
    {
        //
    }
}
