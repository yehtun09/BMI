<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    protected $product_categories;
    public function __construct(ProductCategory $product_categories)
    {
        $this->product_categories = $product_categories;
    }
    public function index()
    {
        abort_if(Gate::denies("product_category_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_categories = $this->product_categories->get();
        return view('admin.productCategory.index',compact('product_categories'));
    }
    public function create()
    {
        abort_if(Gate::denies("product_category_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category = $this->product_categories->pluck('name','id');
        return view('admin.productCategory.create',compact(['product_category']));
    }
    public function store(StoreProductCategoryRequest $request)
    {
        abort_if(Gate::denies("product_category_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category = $this->product_categories->create($request->all());
        // $user->product_categories()->sync($request->input('product_categories', []));
        return redirect()->route('admin.product-category.index')->with('message' , 'Product Category Create Success!');
    }
    public function show($id)
    {
        abort_if(Gate::denies("product_category_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category = $this->product_categories->findOrFail($id);
        return view('admin.productCategory.show',compact('product_category'));
    }
    public function edit($id)
    {
        abort_if(Gate::denies("product_category_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        // $product_categories = $this->product_categories->all();
        $product_category = $this->product_categories->findOrFail($id);
        return view('admin.productCategory.edit',compact(['product_category']));
    }
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        abort_if(Gate::denies("product_category_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category = $this->product_categories->findOrFail($id);
        $product_category->update($request->all());
        // $product_category->product_categories()->sync($request->input('product_categories', []));

        return redirect()->route('admin.product-category.index')->with('message' ,'Product Category Update Successfuly!');
    }

    public function showTrash()
    {
        $product_categories = $this->product_categories->onlyTrashed()->get();
        return view('admin.productCategory.trashList', compact('product_categories'));
    }

    public function restoreTrash($id)
    {
        $product_category = $this->product_categories->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product-category.index')->with('message' , 'Product Category Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->product_categories->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.product-category.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product-category.showTrash')->with("message","Fail");
        }
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("product_category_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $product_category = $this->product_categories->findOrFail($id);
        $product_category->delete();
        return redirect()->route('admin.product-category.index')->with('message' ,'Product Category Delete Successfuly!');
    }
    // public function massDestroy(MassDestroyproduct_categoryRequest $request)
    // {
    //     User::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
    
}
