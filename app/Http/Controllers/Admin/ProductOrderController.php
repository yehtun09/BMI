<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductOrderRequest;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductOrderController extends Controller
{
    protected $products;
    protected $product_orders;
    protected $buyers;

    public function __construct(Product $products,ProductOrder $product_orders,Buyer $buyers)
    {
        $this->products = $products;
        $this->product_orders = $product_orders;
        $this->buyers = $buyers;
    }

    public function index()
    {
        abort_if(Gate::denies("product_order_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product_orders = $this->product_orders->with('buyer','product')->get();
        return view('admin.productOrder.index', compact('product_orders'));
    }

    public function create()
    {
        // abort_if(Gate::denies("product_order_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        // $products = $this->products->all();
        // $buyers = $this->buyers->all();
        // return view('admin.productOrder.create',compact(['products','buyers']));
    }

    public function store(StoreProductRequest $request)
    {
        // abort_if(Gate::denies("product_order_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        // $product = $this->products->create($request->all());
        // if($request->photo)
        // {
        //     $product->addMediaFromRequest("photo")
        //     ->usingName("spatie Media")
        //     ->toMediaCollection("photo");
        // }
        // return redirect()->route('admin.products.index')->with('message', 'Product created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("product_order_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product_order = $this->product_orders->with('buyer','product')->findOrFail($id);
        return view('admin.productOrder.show', compact('product_order'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("product_order_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product_order = $this->product_orders->findOrFail($id);
        $buyers = $this->buyers->all();
        $products = $this->products->all();
        return view('admin.productOrder.edit',compact(['buyers','product_order','products']));
    }

    public function update(UpdateProductOrderRequest $request, $id)
    {
       
        abort_if(Gate::denies("product_order_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product_order = $this->product_orders->findOrFail($id);
        $product_order->update($request->all());
        return redirect()->route('admin.product-order.index')->with('message', 'Product Order updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("product_order_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product_orders = $this->product_orders->findOrFail($id);
        $product_orders->delete();
        return redirect()->route('admin.product-order.index')->with('message', 'Product Order deleted successfully!');
    }

    public function showTrash()
    {
        $product_orders = $this->product_orders->onlyTrashed()->with('buyer','product')->get();
        return view('admin.productOrder.trashList', compact('product_orders'));
    }

    public function restoreTrash($id)
    {
        $product_orders = $this->product_orders->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product-order.index')->with('message' , 'Product Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $product_orders = $this->product_orders->withTrashed()->find($id);

        if ($product_orders) {
            $product_orders->forceDelete();
                return redirect()->route('admin.product-order.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product-order.showTrash')->with("message","Fail");
        }
    }

    // public function getmeasurement(Request $request,$id)
    // {
    //     $product_categories = $this->measurements->where('product_category_id',$id)->get();
    //     if($request->ajax()){
    //         return response()->json([
    //             'product_categories' => $product_categories
    //         ]);
    //     }
    // }
}