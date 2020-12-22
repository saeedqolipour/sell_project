<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
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
        $checkExist = User::where('national_code', $request->get('nationalCode'))->first();
        if (!$checkExist) {
            $user = User::create([
                'first_name' => $request->get('firstName'),
                'last_name' => $request->get('lastName'),
                'national_code' => $request->get('nationalCode'),
                'mobile_number' => $request->get('mobileNumber'),
            ]);
            if ($user) {
                UserWallet::create([
                    'user_id' => $user->id,
                    'wallet_balance' => 0
                ]);
                return response()->json(['status' => 200, 'title' => 'موفقیت آمیز', 'type' => 'success', 'message' => 'عملیات با موفقیت انجام شد ']);
            } else {
                return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'ظاهرا مشکلی در ثبت کاربر به وجود آمده ']);
            }
        } else {
            return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'این کد ملی قبلا در سیستم ثبت شده است ']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function wallet(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('national_code', $request->get('nationalCode'))->with('wallet')->first();
        if (!$user) {
            return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'این کد ملی در سیستم یافت نشد']);
        } else {
            return response()->json(['wallet' => $user->wallet->wallet_balance, 'nameAndFamily' => $user->first_name . ' ' . $user->last_name]);
        }
    }
}
