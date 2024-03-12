<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductOrderRequest;
use App\Models\Buyer;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMeasurement;
use App\Models\ProductOrder;
use App\Models\ProductOrderDetail;
use App\Models\ProductOrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function buyerAllProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Error!',
                'error' => $validator->errors(),
                'data' => [],
            ], 400);
        }
        $buyer_id = $request->buyer_id;
        $buyer = Buyer::find($buyer_id);
        // $productCategory = ProductCategory::with('products','measurements')->get();
        $productCategory = ProductMeasurement::with('measurement','product','productCategory')->where('product_category_id',$buyer->buyer_category)->get();
        $measurements = Measurement::where('product_category_id',$buyer->buyer_category)->get();
        
        return  response()->json([
            "code" => 200,
            "message"=> 'Success!',
            "data" => [
                "products" => $productCategory,
                "measurements" => $measurements
            ]
        ],200);
    }

    public function productOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders.buyer_id' => 'required',
            'orders.order_date' => 'required',
            'orders.delivery_address' => 'required',
            'orders.phone_no' => 'required',
            'products.*.product_id' => 'required',
            'products.*.qty' => 'required',
            'products.*.total_amount' => 'required',
            'products.*.measurement_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Error!',
                'error' => $validator->errors(),
                'data' => [],
            ], 400);
        }

        $productOrders = $request->orders;
        $productOrderDetail = $request->products;
        $returnOrders = [];
        $status_id = 1;

        $productorder_id = ProductOrder::insertGetId([
                'buyer_id'  => $productOrders['buyer_id'],
                'order_date'  => $productOrders['order_date'],
                'delivery_address'  => $productOrders['delivery_address'],
                'phone_no'  => $productOrders['phone_no'],
            ]);
          $productOrderStatus = ProductOrderStatus::create([
                'status_id'  => $status_id,
                'user_id'  => 1,
                'date'  => $productOrders['order_date'],
                'product_order_id'  => $productorder_id,

            ]);
        foreach($productOrderDetail as $productorder)
        {
            $product_id = $productorder['product_id'];
            // $buyer_id = $productorder['buyer_id'];
            // $order_date = $productorder['order_date'];
            $qty = $productorder['qty'];
            $total_amount = $productorder['total_amount'];
            // $delivery_address = $productorder['delivery_address'];
            // $phone_no = $productorder['phone_no'];
            // $status_id = 1;
            // $productorder_id = ProductOrder::insertGetId([
            //     'buyer_id'  => $buyer_id,
            //     'order_date'  => $order_date,
            //     'delivery_address'  => $delivery_address,
            //     'phone_no'  => $phone_no,
            // ]);
            $productOrderDetail = ProductOrderDetail::create([
                'product_order_id'  => $productorder_id,
                'product_id'  => $product_id,
                'qty'  => $qty,
                'total_amount'  => $total_amount,
                'measurement_id'    => $productorder['measurement_id'],
            ]);
            // $productOrderStatus = ProductOrderStatus::create([
            //     'status_id'  => $status_id,
            //     'user_id'  => 1,
            //     'date'  => $order_date,
            //     'product_order_id'  => $productorder_id,

            // ]);
            // $productorder = ProductOrder::create($productorder);
            $returnOrd =  array_push($returnOrders , $productorder);
        }
        
        return  response()->json([
            "code" => 200,
            "message"=> 'Success!',
            "data" => $returnOrders
        ],200);
    }

    public function productOrderHistory(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'buyer_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'code' => 400,
            'message' => 'Error!',
            'error' => $validator->errors(),
            'data' => [],
        ], 400);
    }

    $buyer_id = $request->buyer_id;
    $productOrders = ProductOrder::with('statues.status', 'prouductOrderDetails.product.productMeasurement')
        ->where('buyer_id', $buyer_id)
        ->get();
    $productOrders->load('prouductOrderDetails.measurement');
    $Orders =[];
    $formattedOrders = [];
    foreach ($productOrders  as $productOrder)
    {
        $productOrders = [
            'order_date' => $productOrder->order_date,
            'delivery_address' => $productOrder->delivery_address,
            'phone_no' => $productOrder->phone_no,
            "status"    => $productOrder->statues[0]->status->name,
            "status_id"    => $productOrder->statues[0]->status->id,
            "productOrderDetails" => []
        ];
        if($productOrder->prouductOrderDetails)
        {
            foreach($productOrder->prouductOrderDetails as $product)
            {
                // return $product->product->productMeasurement->photo->original_url;
                $products = [
                    "qty"           => $product->qty,
                    "total_amount"  => $product->total_amount,
                    "product_name"  => $product->product->name,
                    "measurement"   => $product->measurement->name,
                    "media"         => $product->product->productMeasurement->photo->original_url ?? [],
                ];
                $productOrders["productOrderDetails"][] =  $products;
            }
        }
        $order =  array_push($Orders , $productOrders);
    }
    
    return response()->json([
        'code' => 200,
        'message' => 'Success!',
        'data' => $Orders,
    ], 200);
    }

}
