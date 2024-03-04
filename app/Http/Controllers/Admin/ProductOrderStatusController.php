<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductOrderStatusRequest;
use App\Http\Requests\updateProductOrderStatusRequest;
use App\Models\ProductOrder;
use App\Models\ProductOrderStatus;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductOrderStatusController extends Controller
{
    protected $productOrderStatus;
    protected $productOrders;
    protected $users;
    protected $status;

    public function __construct(ProductOrderStatus $productOrderStatus ,ProductOrder $productOrder,User $user,Status $status) 
    {
        $this->productOrderStatus = $productOrderStatus;
        $this->productOrders = $productOrder;
        $this->users = $user;
        $this->status = $status;
    }

    public function index()
    {
        abort_if(Gate::denies("product_order_status_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productOrderStatuses = $this->productOrderStatus->with('productOrder', 'productOrder', 'user', 'status')->get();
        $productOrderStatuses->load('productOrder.product');

        // $productOrderStatuses = $this->productOrderStatus
        // ->with('productOrder.product') 
        // ->with('user', 'status')
        // ->get();
        return view('admin.productOrderStatus.index', compact('productOrderStatuses'));
    }

    public function create()
    {
        // Add logic if needed for creating a new product order status
    }

    public function store(StoreProductOrderStatusRequest $request)
    {
        // Add logic if needed for storing a new product order status
    }

    public function show($id)
    {
        abort_if(Gate::denies("product_order_status_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productOrderStatus = $this->productOrderStatus->with('productOrder.buyer', 'productOrder.product', 'user', 'status')->findOrFail($id);
        return view('admin.productOrderStatus.show', compact('productOrderStatus'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("product_order_status_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productOrderStatus = $this->productOrderStatus->findOrFail($id);
        $users = $this->users->all();
        $productOrders = $this->productOrders->with('product')->get();
        $statuses = $this->status->all();
        // Add logic to fetch additional data if needed
        return view('admin.productOrderStatus.edit', compact(['productOrderStatus','users','productOrders','statuses']));
    }

    public function update(updateProductOrderStatusRequest $request, $id)
    {
        abort_if(Gate::denies("product_order_status_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productOrderStatus = $this->productOrderStatus->findOrFail($id);
        $productOrderStatus->update($request->all());
        return redirect()->route('admin.product-order-status.index')->with('message', 'Product Order Status updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("product_order_status_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productOrderStatus = $this->productOrderStatus->findOrFail($id);
        $productOrderStatus->delete();
        return redirect()->route('admin.product-order-status.index')->with('message', 'Product Order Status deleted successfully!');
    }

    public function showTrash()
    {
        $productOrderStatuses = $this->productOrderStatus->onlyTrashed()->with('productOrder.buyer', 'productOrder.product', 'user', 'status')->get();
        return view('admin.productOrderStatus.trashList', compact('productOrderStatuses'));
    }

    public function restoreTrash($id)
    {
        $productOrderStatus = $this->productOrderStatus->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product-order-status.index')->with('message', 'Product Order Status Restore Successfully!');
    }

    public function trashDelete($id)
    {
        $productOrderStatus = $this->productOrderStatus->withTrashed()->find($id);

        if ($productOrderStatus) {
            $productOrderStatus->forceDelete();
            return redirect()->route('admin.product-order-status.showTrash')->with('message', "Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product-order-status.showTrash')->with("message", "Fail");
        }
    }
}
