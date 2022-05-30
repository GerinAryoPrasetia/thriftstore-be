<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all registered seller on website
        return Seller::all();
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
     * @param  \App\Http\Requests\StoreSellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct(Request $request, Seller $seller)
    {
        //Store product by seller
        // $fields = $request->validate([
        //     'product_name' => 'required',
        //     'size' => 'required',
        //     'price' => 'required',
        //     'description' => 'required',
        //     'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     // 'sold_number' => 'nullable'
        // ]);

        // $image = $request->file('image');
        // Storage::disk('public')->put('images', $image);

        // $product = Product::create([
        //     'product_name' => $fields['product_name'],
        //     'size' => $fields['size'],
        //     'price' => $fields['price'],
        //     'description' => $fields['description'],
        //     'image' => $image->hashName(),
        //     // 'sold_number' => $fields['sold_number']
        // ]);

        // $response = [
        //     'code' => 201,
        //     'message' => 'Data Berhasil Ditambahkan',
        //     'product' => $product,
        // ];
        // return response($response, 201);
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'size' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $this->validate($request, [
                'product_name' => 'required',
                'size' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $validator->errors()
                    ],
                    500
                );
            }

            $image = $request->file('image');
            Storage::disk('public')->put('images', $image);

            $product = new Product([
                'product_name' => $request->get('product_name'),
                'size' => $request->get('size'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
                'image' => $image->hashName(),
            ]);

            if ($seller->products()->save($product)) {
                return response()->json(['message' => 'Product Saved', 'data' => $product], 200);
            }
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'product data successfully added',
                    'data' => $product,
                ],
                200
            );
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show_products(Seller $seller)
    {
        //
        $products = $seller->products;
        if (count($products) > 0) {
            return response()->json([
                'message' => 'Success',
                'data' => $products,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Not Found',
                'data' => null,
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellerRequest  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete product by seller
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Product successfully deleted',
            ],
            200
        );
    }
}
