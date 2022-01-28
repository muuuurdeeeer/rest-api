<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = ProductResource::collection(Product::all()); // обертываем записи из модели в коллекцию и выводим через ресурс
        return response($res, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([ // валидируем входящие данные
            'name' => 'required',
            'description' => 'required',
        ]);

        $res = new ProductResource(Product::create($val)); // создаем строку с валидированными данными, обертывая ее в ресурс, чтобы выдать адекватный ответ
        return response($res, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) // мы принимаем экземпляр модели
    {
        $res = new ProductResource($product);
        return response($res, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $val = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Product::findOrFail($id)->update($val);
        return response(['message' => 'Product has been updated '], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return response(['message' => 'Product has been removed '], 200);
    }
}
