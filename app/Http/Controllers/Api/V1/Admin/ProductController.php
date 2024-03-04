<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductOrderRequest;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function buyerAllProduct($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Error!',
                'error' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        $buyer = Buyer::find($id);
        // $productCategory = ProductCategory::with('products','measurements')->get();
        $productCategory = Product::with('measurement')->where('product_category_id',$buyer->buyer_category)->get();
        
        return  response()->json([
            "code" => 200,
            "message"=> 'Success!',
            "data" => $productCategory
        ],200);
    }

    public function productOrder(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            '*.product_id' => 'required',
            '*.buyer_id' => 'required',
            '*.order_date' => 'required',
            '*.qty' => 'required',
            '*.total_amount' => 'required',
            '*.delivery_address' => 'required',
            '*.phone_no' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Error!',
                'error' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        $poductOrders = $request->all();
        $returnOrders = [];
        foreach($poductOrders as $productorder)
        {
            $productorder = ProductOrder::create($productorder);
            $returnOrd =  array_push($returnOrders , $productorder);
        }
        
        return  response()->json([
            "code" => 200,
            "message"=> 'Success!',
            "data" => $returnOrders
        ],200);
    }
}
