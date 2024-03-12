<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductOrderDetailRequest;
use App\Http\Requests\UpdateProductOrderDetailRequest;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductOrderDetailController extends Controller
{
    protected $productOrderDetails;
    protected $measurements;
    protected $productOrders;
    protected $products;

    public function __construct(ProductOrderDetail $productOrderDetails,ProductOrder $productOrders,Product $products,Measurement $measurement)
    {
        $this->productOrderDetails = $productOrderDetails;
        $this->productOrders = $productOrders;
        $this->products = $products;
        $this->measurements  = $measurement;
    }

    public function index()
    {
        abort_if(Gate::denies('product_order_details_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetails = $this->productOrderDetails->with(['productOrder.buyer','product','measurement'])->get();
        // return $productOrderDetails;

        return view('admin.ProductOrderDetails.index', compact('productOrderDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_order_details_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // You can fetch any necessary data for your create form here

        return view('admin.ProductOrderDetails.create');
    }

    public function store(StoreProductOrderDetailRequest $request)
    {
        abort_if(Gate::denies('product_order_details_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->create($request->all());

        // Additional logic for storing related data or handling media uploads

        return redirect()->route('admin.product-order-details.index')->with('message', 'Product Order Detail created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies('product_order_details_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->findOrFail($id);
        $productOrders=$this->productOrders->all();
        $products=$this->products->all();
        return view('admin.ProductOrderDetails.show', compact('productOrderDetail'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('product_order_details_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->with('productOrder.buyer')->findOrFail($id);
        $productOrders=$this->productOrders->all();
        $products=$this->products->all();
        $measurements = $this->measurements->where('product_category_id',$productOrderDetail->productOrder->buyer->buyer_category)->get();
        return view('admin.ProductOrderDetails.edit', compact(['productOrderDetail','productOrders','products','measurements']));
    }

    public function update(UpdateProductOrderDetailRequest $request, $id)
    {
        abort_if(Gate::denies('product_order_details_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->findOrFail($id);
        $productOrderDetail->update($request->all());

        // Additional logic for updating related data or handling media uploads

        return redirect()->route('admin.product-order-details.index')->with('message', 'Product Order Detail updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('product_order_details_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->findOrFail($id);
        $productOrderDetail->delete();

        return redirect()->route('admin.product-order-details.index')->with('message', 'Product Order Detail deleted successfully!');
    }
    public function showTrash()
    {
        $productOrderDetails = $this->productOrderDetails->onlyTrashed()->get();

        return view('admin.ProductOrderDetails.trashList', compact('productOrderDetails'));
    }

    public function restoreTrash($id)
    {
        $productOrderDetail = $this->productOrderDetails->withTrashed()->find($id);
        $productOrderDetail->restore();

        return redirect()->route('admin.product-order-details.index')->with('message', 'Product Order Detail restored successfully!');
    }

    public function trashDelete($id)
    {
        $productOrderDetail = $this->productOrderDetails->withTrashed()->find($id);

        if ($productOrderDetail) {
            // You might want to perform additional cleanup or handle related data before force deleting
            $productOrderDetail->forceDelete();

            return redirect()->route('admin.product-order-details.showTrash')->with('message', 'Product Order Detail permanently deleted successfully!');
        } else {
            return redirect()->route('admin.product-order-details.showTrash')->with('message', 'Failed to delete product order detail from trash');
        }
    }
}
