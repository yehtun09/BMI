<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerTypeRequest;
use App\Http\Requests\UpdateSellerTypeRequest;
use App\Models\SellerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SellerTypeController extends Controller
{
    protected $seller_types;

    public function __construct(SellerType $seller_types)
    {
        $this->middleware("auth");
        $this->seller_types = $seller_types;
    }

    public function index()
    {
        abort_if(Gate::denies('seller_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $seller_types = $this->seller_types->all();
        return view("admin.sellerType.index", compact("seller_types"));
    }

    public function create()
    {
        abort_if(Gate::denies("seller_type_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        return view('admin.sellerType.create');
    }

    public function store(StoreSellerTypeRequest $request)
    {
        abort_if(Gate::denies("seller_type_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_type = $this->seller_types->create($request->all());
        return redirect()->route('admin.seller-type.index')->with('message', 'Seller Type Created Successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("seller_type_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_type = $this->seller_types->withTrashed()->findOrFail($id);
        return view('admin.sellerType.show', compact('seller_type'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("seller_type_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_type = $this->seller_types->findOrFail($id);
        return view('admin.sellerType.edit', compact('seller_type'));
    }

    public function update(UpdateSellerTypeRequest $request, $id)
    {
        abort_if(Gate::denies("seller_type_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_type = $this->seller_types->findOrFail($id);
        $seller_type->update($request->all());
        return redirect()->route('admin.seller-type.index')->with('message', 'Seller Type Updated Successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("seller_type_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_type = $this->seller_types->findOrFail($id);
        $seller_type->delete();
        return redirect()->route('admin.seller-type.index')->with('message', 'Seller Type Deleted Successfully!');
    }

    public function restoreTrash($id)
    {
        abort_if(Gate::denies("seller_type_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $seller_types = $this->seller_types->withTrashed()->find($id)->restore();
        return redirect()->route('admin.seller-type.index')->with('message', 'Seller Type Restored Successfully!');
    }

    public function showTrash()
    {
        $seller_types= $this->seller_types->onlyTrashed()->get();

        return view('admin.sellerType.trashList', compact('seller_types'));
    }
    public function trashDelete($id)
    {
        $productOrderDetail = $this->seller_types->withTrashed()->find($id);

        if ($productOrderDetail) {
            $productOrderDetail->forceDelete();

            return redirect()->route('admin.seller-type.showTrash')->with('message', 'Product Order Detail permanently deleted successfully!');
        } else {
            return redirect()->route('admin.seller-type.showTrash')->with('message', 'Failed to delete product order detail from trash');
        }
    }
}
