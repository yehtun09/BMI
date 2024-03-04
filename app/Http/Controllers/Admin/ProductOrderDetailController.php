<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductOrderDetailRequest;
use App\Http\Requests\UpdateProductOrderDetailRequest;
use App\Models\ProductOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductOrderDetailController extends Controller
{
    protected $productOrderDetails;

    public function __construct(ProductOrderDetail $productOrderDetails)
    {
        $this->productOrderDetails = $productOrderDetails;
    }

    public function index()
    {
        abort_if(Gate::denies('product_order_details_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetails = $this->productOrderDetails->with('buyer')->get();

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

        return view('admin.ProductOrderDetails.show', compact('productOrderDetail'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('product_order_details_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productOrderDetail = $this->productOrderDetails->findOrFail($id);

        // You can fetch any necessary data for your edit form here

        return view('admin.ProductOrderDetails.edit', compact('productOrderDetail'));
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

        return view('admin.product_order_details.trashList', compact('productOrderDetails'));
    }

    public function restoreTrash($id)
    {
        $productOrderDetail = $this->productOrderDetails->withTrashed()->find($id);
        $productOrderDetail->restore();

        return redirect()->route('admin.product_order_details.index')->with('message', 'Product Order Detail restored successfully!');
    }

    public function trashDelete($id)
    {
        $productOrderDetail = $this->productOrderDetails->withTrashed()->find($id);

        if ($productOrderDetail) {
            // You might want to perform additional cleanup or handle related data before force deleting
            $productOrderDetail->forceDelete();

            return redirect()->route('admin.product_order_details.showTrash')->with('message', 'Product Order Detail permanently deleted successfully!');
        } else {
            return redirect()->route('admin.product_order_details.showTrash')->with('message', 'Failed to delete product order detail from trash');
        }
    }
}
