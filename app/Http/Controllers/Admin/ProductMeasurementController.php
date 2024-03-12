<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductMeasurementRequest;
use App\Http\Requests\UpdateProductMeasurementRequest;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductMeasurementController extends Controller
{
    use MediaUploadingTrait;
    protected $productMeasurements;
    protected $productCategories;
    protected $measurements;
    protected $products;

    public function __construct(ProductMeasurement $productMeasurements, ProductCategory $productCategory, Measurement $measurement,Product $product)
    {
        $this->productMeasurements = $productMeasurements;
        $this->products = $product;
        $this->productCategories = $productCategory;
        $this->measurements = $measurement;
    }

    public function index()
    {
        abort_if(Gate::denies("product_measurement_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productMeasurements = $this->productMeasurements->with('measurement', 'productCategory','product')->get();
        return view('admin.productMeasurements.index', compact('productMeasurements'));
    }

    public function create()
    {
        abort_if(Gate::denies("product_measurement_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productCategories = $this->productCategories->all()->pluck('name','id');
        $measurements = $this->measurements->all()->pluck('name','id');
        $products = $this->products->all()->pluck('name','id');
        return view('admin.productMeasurements.create', compact(['productCategories', 'measurements','products']));
    }

    public function store(StoreProductMeasurementRequest $request)
    {
        abort_if(Gate::denies("product_measurement_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $productMeasurements= $this->productMeasurements->create($request->all());
        if ($request->input('photo', false)) {
            $productMeasurements->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            // $productMeasurements->addMedia(public_path(basename($request->input('photo'))))->toMediaCollection('photo');
        }
        
        return redirect()->route('admin.product-measurements.index')->with('message', 'Product Measurement created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("product_measurement_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productMeasurement = $this->productMeasurements->with('measurement', 'productCategory','product')->findOrFail($id);
        return view('admin.productMeasurements.show', compact('productMeasurement'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("product_measurement_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productMeasurement = $this->productMeasurements->findOrFail($id);
        $productCategories = $this->productCategories->all()->pluck('name', 'id');
        $measurements = $this->measurements->all()->pluck('name', 'id');
        $products = $this->products->all()->pluck('name','id');
        return view('admin.productMeasurements.edit', compact(['productMeasurement', 'productCategories', 'measurements','products']));
    }

    public function update(UpdateProductMeasurementRequest $request, $id)
    {
        abort_if(Gate::denies("product_measurement_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $productMeasurement = $this->productMeasurements->findOrFail($id);
        $productMeasurement->update($request->all());
        if ($request->input('photo')) {
            if (!$productMeasurement->photo || $request->input('photo') !== $productMeasurement->photo->file_name) {
                if ($productMeasurement->photo) {
                    // return "deletePhoto";    
                    $productMeasurement->photo->delete();
                }
                $productMeasurement->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($productMeasurement->photo) {

            $productMeasurement->photo->delete();
        }
        
        return redirect()->route('admin.product-measurements.index')->with('message', 'Product Measurement updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("product_measurement_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $productMeasurement = $this->productMeasurements->findOrFail($id);
        $productMeasurement->delete();
        return redirect()->route('admin.product-measurements.index')->with('message', 'Product Measurement deleted successfully!');
    }

    public function showTrash()
    {
        $productMeasurements = $this->productMeasurements->onlyTrashed()->with('measurement','productCategory','product')->get();
        return view('admin.productMeasurements.trashList', compact('productMeasurements'));
    }

    public function restoreTrash($id)
    {
        $productMeasurements = $this->productMeasurements->withTrashed()->find($id)->restore();
        return redirect()->route('admin.product-measurements.index')->with('message' , 'ProductMeasurement Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $productMeasurements = $this->productMeasurements->withTrashed()->find($id);

        if ($productMeasurements) {
            $productMeasurements->forceDelete();
            if ($productMeasurements->photo) {
                $productMeasurements->photo->delete();
            }
                return redirect()->route('admin.product-measurements.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.product-measurements.showTrash')->with("message","Fail");
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
