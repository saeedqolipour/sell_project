<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersOrder;
use App\Models\UsersWallet;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserController extends Controller implements JWTSubject
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::get();
        return response()->json(['users' => $users]);
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
                UsersWallet::create([
                    'user_id' => $user->id,
                    'wallet_balance' => 0
                ]);
                Log::info('Register New User : ' . $request->get('nationalCode'));
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

    public function getReport(Request $request)
    {
        $orders = UsersOrder::where('user_id', $request->get('userId'))->with('product')->latest()->get();
        $items = [];
        foreach ($orders as $order) {
            $date = Verta::instance($order->created_at);
            $date->timezone('Asia/Tehran');
            $items[] = ['id' => $order->id, 'user_id' => $order->user_id, 'product' => $order->product[0]->product_name, 'price' => $order->price . ' تومان ', 'date' => $date->year . '-' . $date->month . '-' . $date->day, 'time' => $date->hour . ':' . $date->minute];
        }
        if ($orders) {
            return response()->json(['orders' => $items]);
        } else {
            return 0;
        }
    }

    public function checkLogin(Request $request)
    {
        if ($request->username === 'admin' && $request->password === 'admin') {
            return response()->json(['status' => 1]);
        }
        Log::info('Access Denied = Username :  ' . $request->username . ' ' . ' Password :  ' . $request->password);
        return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'عدم دسترسی به پنل مدیریت']);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
