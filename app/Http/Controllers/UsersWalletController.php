<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersWalletController extends Controller
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
        $user = User::where('national_code', $request->get('nationalCode'))->first();
        if ($user) {
            $userWallet = UsersWallet::where('user_id', $user->id)->first();
            $userWallet->wallet_balance = $userWallet->wallet_balance + $request->get('chargeValue');
            $userWallet->save();
            if ($userWallet) {
                Log::info('Wallet Charge :  ' . $request->get('national_code') . ' Value :  ' . $request->get('chargeValue') . ' Toman');
                return response()->json(['status' => 200, 'title' => 'موفقیت آمیز', 'type' => 'success', 'message' => 'عملیات با موفقیت انجام شد ']);
            } else {
                return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'ظاهرا مشکلی در افزایش موجودی پیش امده است']);
            }
        } else {
            return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'کاربری با این کد ملی یافت نشد']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UsersWallet $usersWallet
     * @return \Illuminate\Http\Response
     */
    public function show(UsersWallet $usersWallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UsersWallet $usersWallet
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersWallet $usersWallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UsersWallet $usersWallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersWallet $usersWallet)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UsersWallet $usersWallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersWallet $usersWallet)
    {
        //
    }
}
