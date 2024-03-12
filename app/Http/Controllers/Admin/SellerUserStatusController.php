<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeSellerUserStatusRrequest;
use App\Http\Requests\updateSellerUserStatusRrequest;
use App\Models\SellerProduct;
use App\Models\SellerUserStatus;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SellerUserStatusController extends Controller
{
    protected $sellerUserStatus;

    public function __construct(SellerUserStatus $sellerUserStatus)
    {
        $this->sellerUserStatus = $sellerUserStatus;
    }

    public function index()
    {
        abort_if(Gate::denies('seller_user_status_access'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatuses = $this->sellerUserStatus->with(['sellerProduct.sellerProductType', 'user', 'status'])->get();

        return view('admin.sellerUserStatus.index', compact('sellerUserStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('seller_user_status_create'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerProducts = SellerProduct::with('sellerProductType')->get();
        $users = User::all()->pluck('name' , 'id');
        $statuses = Status::all()->pluck('name' , 'id');

        return view('admin.sellerUserStatus.create', compact('sellerProducts', 'users', 'statuses'));
    }

    public function store(storeSellerUserStatusRrequest $request)
    {
        abort_if(Gate::denies('seller_user_status_create'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatus = $this->sellerUserStatus->create($request->all());

        return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Seller User Status created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies('seller_user_status_show'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatus = $this->sellerUserStatus->findOrFail($id);

        return view('admin.sellerUserStatus.show', compact('sellerUserStatus'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('seller_user_status_edit'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatus = $this->sellerUserStatus->findOrFail($id);
        $sellerProducts = SellerProduct::all();
        $users = User::all()->pluck('name','id');
        $statuses = Status::all()->pluck('name','id');

        return view('admin.sellerUserStatus.edit', compact('sellerUserStatus', 'sellerProducts', 'users', 'statuses'));
    }

    public function update(updateSellerUserStatusRrequest $request, $id)
    {
        abort_if(Gate::denies('seller_user_status_edit'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatus = $this->sellerUserStatus->findOrFail($id);
        $sellerUserStatus->update($request->all());

        return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Seller User Status updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('seller_user_status_delete'), Response::HTTP_FORBIDDEN, "403 Forbidden");

        $sellerUserStatus = $this->sellerUserStatus->findOrFail($id);
        $sellerUserStatus->delete();

        return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Seller User Status moved to trash successfully!');
    }

    public function showTrash()
    {
        $sellerUserStatuses = $this->sellerUserStatus->onlyTrashed()->get();

        return view('admin.sellerUserStatus.trashList', compact('sellerUserStatuses'));
    }

    public function restoreTrash($id)
    {
        $sellerUserStatus = $this->sellerUserStatus->withTrashed()->find($id)->restore();

        return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Seller User Status restored successfully!');
    }

    public function trashDelete($id)
    {
        $sellerUserStatus = $this->sellerUserStatus->withTrashed()->find($id);

        if ($sellerUserStatus) {
            $sellerUserStatus->forceDelete();

            return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Trash Data deleted successfully!');
        } else {
            return redirect()->route('admin.seller-user-statuses.index')->with('message', 'Failed to delete trash data!');
        }
    }
}
