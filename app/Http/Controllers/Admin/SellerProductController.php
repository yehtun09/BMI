<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSellerProductRequest;
use App\Http\Requests\UpdateSellerProductRequest;
use App\Models\Measurement;
use App\Models\SellerProduct;
use App\Models\SellerProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SellerProductController extends Controller
{
    use MediaUploadingTrait;

    protected $sellerProducts;
    protected $sellerProductTypes;
    protected $measurements;

    public function __construct(SellerProduct $sellerProducts, SellerProductType $sellerProductTypes, Measurement $measurements)
    {
        $this->sellerProducts = $sellerProducts;
        $this->sellerProductTypes = $sellerProductTypes;
        $this->measurements = $measurements;
    }

    public function index()
    {
        abort_if(Gate::denies("seller_product_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProducts = $this->sellerProducts->with('sellerProductType', 'measurement')->get();
        // return $sellerProducts->media;
        return view('admin.sellerproducts.index', compact('sellerProducts'));
    }

    public function create()
    {
        abort_if(Gate::denies("seller_product_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProductTypes = $this->sellerProductTypes->all()->pluck('name', 'id');
        $measurements = $this->measurements->all()->where('type', 1)->pluck('name', 'id');
        return view('admin.sellerproducts.create', compact(['sellerProductTypes', 'measurements']));
    }

    public function store(StoreSellerProductRequest $request)
    {
        // return $request->all();
        abort_if(Gate::denies("seller_product_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProduct = $this->sellerProducts->create($request->all());
        if ($request->input('photo', false)) {
            $sellerProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return redirect()->route('admin.seller-product.index')->with('message', 'Seller Product created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("seller_product_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProduct = $this->sellerProducts->with('sellerProductType', 'measurement')->findOrFail($id);
        return view('admin.sellerproducts.show', compact('sellerProduct'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("seller_product_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProduct = $this->sellerProducts->findOrFail($id);
        $sellerProductTypes = $this->sellerProductTypes->all()->pluck('name', 'id');
        $measurements = $this->measurements->all()->pluck('name', 'id');
        return view('admin.sellerproducts.edit', compact(['sellerProductTypes', 'measurements', 'sellerProduct']));
    }

    public function update(UpdateSellerProductRequest $request, $id)
    {
        abort_if(Gate::denies("seller_product_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProduct = $this->sellerProducts->findOrFail($id);
        $sellerProduct->update($request->all());
        // Handle media uploading if needed

        if ($request->input('photo')) {
            if (!$sellerProduct->photo || $request->input('photo') !== $sellerProduct->photo->file_name) {
                if ($sellerProduct->photo) {
                    // return "deletePhoto";    
                    $sellerProduct->photo->delete();
                }
                $sellerProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($sellerProduct->photo) {

            $sellerProduct->photo->delete();
        }
        return redirect()->route('admin.seller-product.index')->with('message', 'Seller Product updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("seller_product_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $sellerProduct = $this->sellerProducts->findOrFail($id);
        $sellerProduct->delete();

        return redirect()->route('admin.seller-product.index')->with('message', 'Seller Product deleted successfully!');
    }


    public function showTrash()
    {
        $sellerProducts = $this->sellerProducts->onlyTrashed()->with('sellerProductType','measurement')->get();
        return view('admin.sellerproducts.trashList', compact('sellerProducts'));
    }

    public function restoreTrash($id)
    {
        $product_category = $this->sellerProducts->withTrashed()->find($id)->restore();
        return redirect()->route('admin.seller-product.index')->with('message' , 'Product Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $product = $this->sellerProducts->withTrashed()->find($id);

        try {
            $product->forceDelete();
                if ($product->photo) {
                    $product->photo->delete();
                }
                    return redirect()->route('admin.seller-product.trash')->with('message',"Trash Data Delete Successfully!");
        }catch(Throwable $error) {
            return redirect()->route('admin.seller-product.trash')->with("wrong_message","You can't delete this data!");
            
        }
        // if ($product) {
        //     $product->forceDelete();
        //     if ($product->photo) {
        //         $product->photo->delete();
        //     }
        //         return redirect()->route('admin.product.showTrash')->with('message',"Trash Data Delete Successfully!");
        // } else {
        //     return redirect()->route('admin.product.showTrash')->with("message","Fail");
        // }
    }
}
