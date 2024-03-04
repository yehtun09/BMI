<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BuyersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuyerRequest;
use App\Http\Requests\UpdateBuyerRequest;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class BuyerController extends Controller
{
    protected $buyers;
    public function __construct(Buyer $buyer)
    {
        $this->buyers = $buyer;
    }
    public function index()
    {
        abort_if(Gate::denies("permission_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $buyers = $this->buyers->all();
        return view('admin.buyers.index',compact('buyers'));
        
    }

    public function create()
    {
        //
    }

    public function store(StoreBuyerRequest $request)
    {
        //
    }

    public function show($id)
    {
        abort_if(Gate::denies("buyer_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $buyer = $this->buyers->findOrFail($id);
        return view('admin.buyers.show',compact('buyer'));

    }


    public function edit($id)
    {
        abort_if(Gate::denies("buyer_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $buyer = $this->buyers->findOrFail($id);
        return view('admin.buyers.edit',compact('buyer'));
    }


    public function update(UpdateBuyerRequest $request, $id)
    {
        abort_if(Gate::denies("buyer_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $buyer = $this->buyers->findOrFail($id);
        $buyer->update($request->all());
        return redirect()->route('admin.buyers.index')->with('message', 'Buyer Update Successfully!');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("buyer_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $buyer = $this->buyers->findOrFail($id);
        $buyer->delete();
        return redirect()->route('admin.buyers.index')->with('message', 'Add Trash Bin Successfully!');
    }

    public function showTrash()
    {
        $buyers = $this->buyers->onlyTrashed()->get();
        return view('admin.buyers.trashList', compact('buyers'));
    }

    public function restoreTrash($id)
    {
        $buyer = $this->buyers->withTrashed()->find($id)->restore();
        return redirect()->route('admin.buyers.index')->with('message' , 'Buyer Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->buyers->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.buyers.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.buyers.showTrash')->with("message","Fail");
        }
    }

    public function exportCsv()
    {
        return Excel::download(new BuyersExport, 'buyers.xlsx');
    //    dd(Excel::download(new BuyersExport, 'buyers.xlsx'));
    }
}
