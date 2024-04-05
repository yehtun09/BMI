<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerProductTypeRequest;
use App\Http\Requests\UpdateSellerProductTypeRequest;
use App\Models\SellerProductCategory;
use App\Models\SellerProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SellerProductTypeController extends Controller
{
    protected $seller_product_types;
    protected $seller_product_categories;
    public function __construct( SellerProductType $seller_product_types,SellerProductCategory $seller_product_categories)
    {
       $this->middleware("auth");
       $this->seller_product_types = $seller_product_types;
       $this->seller_product_categories = $seller_product_categories;
   }

    public function index()
    {
        abort_if(Gate::denies('seller_product_type_access'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        $seller_product_types = $this->seller_product_types->with('sellerProductCategory')->get();
        return view("admin.sellerProductType.index", compact("seller_product_types"));
    }

    public function create()
    {
        abort_if(Gate::denies("seller_product_type_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_types = $this->seller_product_types->all();
        $seller_product_categories = $this->seller_product_categories->all();
        return view('admin.sellerProductType.create',compact(['seller_product_types','seller_product_categories']));
    }

    public function store(StoreSellerProductTypeRequest $request)
    {
        abort_if(Gate::denies("seller_product_type_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_type = $this->seller_product_types->create($request->all());
        return redirect()->route('admin.seller-product-type.index')->with('message','Seller Product Type Create Success!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("seller_product_type_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_type = $this->seller_product_types->with('sellerProductCategory')->findOrFail($id);

        return view('admin.sellerProductType.show',compact('seller_product_type'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("seller_product_type_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_type = $this->seller_product_types->findOrFail($id);
        $seller_product_categories = $this->seller_product_categories->all();
        return view('admin.sellerProductType.edit',compact(['seller_product_type','seller_product_categories']));
    }


    public function update(UpdateSellerProductTypeRequest $request, $id)
    {

        abort_if(Gate::denies("seller_product_type_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_type = $this->seller_product_types->findOrFail($id);
        $seller_product_type->update($request->all());
        return redirect()->route('admin.seller-product-type.index')->with('message','Seller Product Type Update Success!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("seller_product_type_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller_product_type = $this->seller_product_types->findOrFail($id);
        $seller_product_type->delete();
        return redirect()->route('admin.seller-product-type.index')->with('message','Seller Product Type Delete Successfuly!');
    }

    public function showTrash()
    {
        $seller_product_types = $this->seller_product_types->onlyTrashed()->get();
        return view('admin.sellerProductType.trashList', compact('seller_product_types'));
    }

    public function restoreTrash($id)
    {
        $seller_product_type = $this->seller_product_types->withTrashed()->find($id)->restore();
        return redirect()->route('admin.seller-product-type.index')->with('message' , 'Seller Product Type Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->seller_product_types->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.seller-product-type.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.seller-product-type.showTrash')->with("message","Fail");
        }
}
}
