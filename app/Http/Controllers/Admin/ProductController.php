<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redis;
class ProductController extends Controller
{

    protected $products;
    protected $productCategories;
    protected $measurements;

    public function __construct(Product $products,ProductCategory $productCategory,Measurement $measurement)
    {
        $this->products = $products;
        $this->productCategories = $productCategory;
        $this->measurements = $measurement;
    }

    public function index()
    {
        abort_if(Gate::denies("product_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $products = $this->products->with('measurement','productCategory')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies("product_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategories = $this->productCategories->all()->pluck('name','id');
        $measurements = $this->measurements->all()->pluck('name','id');
        return view('admin.products.create',compact(['productCategories','measurements']));
    }

    public function store(StoreProductRequest $request)
    {
        abort_if(Gate::denies("product_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product = $this->products->create($request->all());
        if ($request->input('photo', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }
        // if($request->photo)
        // {
        //     $product->addMediaFromRequest("photo")
        //     ->usingName("spatie Media")
        //     ->toMediaCollection("photo");
        // }
        return redirect()->route('admin.products.index')->with('message', 'Product created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("product_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product = $this->products->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("product_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product = $this->products->findOrFail($id);
        $productCategories = $this->productCategories->all()->pluck('name','id');
        $measurements = $this->measurements->all()->pluck('name','id');
        return view('admin.products.edit',compact(['productCategories','measurements','product']));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        abort_if(Gate::denies("product_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product = $this->products->findOrFail($id);
        // $product->update($request->all());
        
        if ($request->input('photo')) {
            if (!$product->photo || $request->input('photo') !== $product->photo->file_name) {
                if ($product->photo) {
                    // return "deletePhoto";    
                    $product->photo->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($product->photo) {

            $product->photo->delete();
        }
        return redirect()->route('admin.products.index')->with('message', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("product_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $product = $this->products->findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('message', 'Product deleted successfully!');
    }
    public function showTrash()
    {
        $products = $this->products->onlyTrashed()->with('measurement','productCategory')->get();
        return view('admin.products.trashList', compact('products'));
    }

    public function restoreTrash($id)
    {
        $product_category = $this->products->withTrashed()->find($id)->restore();
        return redirect()->route('admin.products.index')->with('message' , 'Product Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $product = $this->products->withTrashed()->find($id);

        if ($product) {
            $product->forceDelete();
            if ($product->photo) {
                $product->photo->delete();
            }
                return redirect()->route('admin.product.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product.showTrash')->with("message","Fail");
        }
    }

    public function getmeasurement(Request $request,$id)
    {
        $product_categories = $this->measurements->where('product_category_id',$id)->get();
        if($request->ajax()){
            return response()->json([
                'product_categories' => $product_categories
            ]);
        }
    }

}
