<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Seller;
use App\Models\SellerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SellerController extends Controller
{
    protected $sellers;
    protected $seller_types;
    public function __construct(Seller $seller,SellerType $seller_type)
    {
        $this->sellers = $seller;
        $this->seller_types = $seller_type;
    }
    public function index()
    {
       
        abort_if(Gate::denies("seller_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $sellers = $this->sellers->with('sellerType')->get();
        return view('admin.seller.index',compact('sellers'));
        
    }

    public function create()
    {
        abort_if(Gate::denies("seller_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $seller = $this->sellers->all();
        $seller_types = $this->seller_types->all();

        return view('admin.seller.create',compact(['seller','seller_types']));
    }

    public function store(StoreSellerRequest $request)
    {
       
        abort_if(Gate::denies("seller_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $sellers = $this->sellers->create($request->all());
        // $seller->sellers()->sync($request->input('sellers', []));
        
        return redirect()->route('admin.seller.index')->with('message' , 'Seller Create Successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("seller_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller = $this->sellers->findOrFail($id);
        return view('admin.seller.show',compact('seller'));

    }


    public function edit($id)
    {
        abort_if(Gate::denies("seller_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller = $this->sellers->findOrFail($id);
        $seller_types = $this->seller_types->all();
        return view('admin.seller.edit',compact('seller','seller_types'));
    }


    public function update(UpdateSellerRequest $request, $id)
    {
        abort_if(Gate::denies("seller_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller = $this->sellers->findOrFail($id);
        $seller->update($request->all());
        return redirect()->route('admin.seller.index')->with('message', 'Seller Update Successfully!');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("seller_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $seller = $this->sellers->findOrFail($id);
        $seller->delete();
        return redirect()->route('admin.seller.index')->with('message', 'Add Trash Bin Successfully!');
    }

    public function showTrash()
    {
        $sellers = $this->sellers->onlyTrashed()->get();
        return view('admin.seller.trashList', compact('sellers'));
    }

    public function restoreTrash($id)
    {
        $seller = $this->sellers->withTrashed()->find($id)->restore();
        return redirect()->route('admin.seller.index')->with('message' , 'Seller Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->sellers->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.seller.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.seller.showTrash')->with("message","Fail");
        }
    }

   
}