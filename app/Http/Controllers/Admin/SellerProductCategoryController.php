<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerProductCategoryRequest;
use App\Http\Requests\UpdateSellerProductCategoryRequest;
use App\Models\SellerProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SellerProductCategoryController extends Controller
{

    protected $sellerProductCategory;

    public function __construct(SellerProductCategory $sellerProductCategory)
    {
        $this->sellerProductCategory = $sellerProductCategory;
    }
    public function index()
    {
        abort_if(Gate::denies("seller_product_category_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategories = $this->sellerProductCategory->all();
        return view('admin.sellerProductCategory.index',compact('productCategories'));

    }
    public function create()
    {
        abort_if(Gate::denies("seller_product_category_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        return view('admin.sellerProductCategory.create');

    }

    public function store(StoreSellerProductCategoryRequest $request)
    {
        abort_if(Gate::denies("seller_product_category_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategory = $this->sellerProductCategory->create($request->all());
        return redirect()->route('admin.sellers-product-categories.index')->with('message' , 'Product Category Create Successfully!');
    }
    public function show($id)
    {
        abort_if(Gate::denies("seller_product_category_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategory = $this->sellerProductCategory->find($id);
        return view('admin.sellerProductCategory.show',compact('productCategory'));

    }
    public function edit($id)
    {
        abort_if(Gate::denies("seller_product_category_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategory = $this->sellerProductCategory->find($id);
        return view('admin.sellerProductCategory.edit',compact('productCategory'));
    }

    public function update(UpdateSellerProductCategoryRequest $request, $id)
    {
        abort_if(Gate::denies("seller_product_category_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategory = $this->sellerProductCategory->find($id);
        $productCategory->update($request->all());
        return redirect()->route('admin.sellers-product-categories.index')->with('message' , 'Product Category Create Successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("seller_product_category_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategory = $this->sellerProductCategory->find($id);
        $productCategory->delete();
        return redirect()->route('admin.sellers-product-categories.index')->with('message' , 'Product Category Delete Successfully!');
    }

    public function showTrash()
    {
        $sellerProductCategory = $this->sellerProductCategory->onlyTrashed()->get();
        return view('admin.sellerProductCategory.trashList', compact('sellerProductCategory'));
    }

    public function restoreTrash($id)
    {
        $seller_product_category = $this->sellerProductCategory->withTrashed()->find($id)->restore();
        return redirect()->route('admin.sellers-product-categories.index')->with('message' , 'Seller Product Category Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->sellerProductCategory->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.sellers-product-categories.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.sellers-product-categories.showTrash')->with("message","Fail");
        }
    }
}
