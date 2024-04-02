<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryPricesRequest;
use App\Http\Requests\UpdateProductCategoryPricesRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryPrices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryPricesController extends Controller
{
    protected $productCategories;
    protected $product_category_prices;
    protected $products;
    public function __construct(ProductCategoryPrices $product_category_prices,ProductCategory $productCategory,Product $product)
    {
        $this->product_category_prices = $product_category_prices;
        $this->productCategories = $productCategory;
        $this->products = $product;
    }
    public function index()
    {
        abort_if(Gate::denies("product_category_prices_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category_prices = $this->product_category_prices->get();
        return view('admin.productCategoryPrices.index',compact('product_category_prices'));
    }
    public function create()
    {
        abort_if(Gate::denies("product_category_prices_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $productCategories = $this->productCategories->all()->pluck('name','id');
        $product_category_prices = $this->product_category_prices->pluck('name','id');
        return view('admin.productCategoryPrices.create',compact(['product_category_prices', 'productCategories']));
    }
    public function store(StoreProductCategoryPricesRequest $request)
    {
        abort_if(Gate::denies("product_category_prices_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category_prices = $this->product_category_prices->create($request->all());
        // $user->product_category_prices()->sync($request->input('product_category_prices', []));
        return redirect()->route('admin.product-category-prices.index')->with('message' , 'Product Category Price Create Success!');
    }
    public function show($id)
    {
        abort_if(Gate::denies("product_category_prices_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category_prices = $this->product_category_prices->findOrFail($id);
        return view('admin.productCategoryPrices.show',compact('product_category_prices'));
    }
    public function edit($id)
    {
        abort_if(Gate::denies("product_category_prices_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        // $product_category_prices = $this->product_category_prices->all();
        $productCategories = $this->productCategories->all()->pluck('name','id');
        $product_category_prices = $this->product_category_prices->findOrFail($id);
        return view('admin.productCategoryPrices.edit',compact(['product_category_prices', 'productCategories']));
    }
    public function update(UpdateProductCategoryPricesRequest $request, $id)
    {
        abort_if(Gate::denies("product_category_prices_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category_prices = $this->product_category_prices->findOrFail($id);
        $product_category_prices->update($request->all());
        // $product_category_prices->product_category_prices()->sync($request->input('product_category_prices', []));

        return redirect()->route('admin.product-category-prices.index')->with('message' ,'Product Category Price Update Successfuly!');
    }

    public function showTrash()
    {
        $product_category_prices = $this->product_category_prices->onlyTrashed()->get();
        return view('admin.productCategoryPrices.trashList', compact('product_category_prices'));
    }

    public function restoreTrash($id)
    {
        $product_category_prices = $this->product_category_prices->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product-category-prices.index')->with('message' , 'Product Category Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->product_category_prices->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.product-category-prices.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product-category-prices.showTrash')->with("message","Fail");
        }
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("product_category_prices_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category_prices = $this->product_category_prices->findOrFail($id);
        $product_category_prices->delete();
        return redirect()->route('admin.product-category-prices.index')->with('message' ,'Product Category Price Delete Successfuly!');
    }
}
