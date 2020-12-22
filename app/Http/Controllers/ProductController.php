<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return response()->json(['products' => $products]);
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
        $checkExist = Product::where('product_name', $request->get('productName'))->where('product_price', $request->get('productPrice'))->first();
        if (!$checkExist) {
            $product = Product::create([
                'product_name' => $request->get('productName'),
                'product_price' => $request->get('productPrice')
            ]);
            if ($product) {
                return response()->json(['status' => 200, 'title' => 'موفقیت آمیز', 'type' => 'success', 'message' => 'عملیات با موفقیت انجام شد ']);
            } else {
                return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'ظاهرا مشکلی در ثبت محصول به وجود آمده ']);
            }
        } else {
            return response()->json(['status' => 0, 'title' => 'خطا', 'type' => 'error', 'message' => 'این محصول قبلا ثبت شده است']);
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
}
