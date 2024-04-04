<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodayPriceRequest;
use App\Http\Requests\UpdateTodayPriceRequest;
use App\Models\TodayPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TodayPriceController extends Controller
{
    protected $today_price;
    public function __construct(TodayPrice $today_price)
    {
        $this->today_price = $today_price;
    }
    public function index()
    {
        abort_if(Gate::denies("today_price_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->get();
        return view('admin.todayPrice.index',compact('today_price'));
    }
    public function create()
    {
        abort_if(Gate::denies("today_price_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->pluck('date', 'type', 'sell_price', 'buy_price', 'remark');
        return view('admin.todayPrice.create',compact(['today_price']));
    }
    public function store(StoreTodayPriceRequest $request)
    {
        abort_if(Gate::denies("today_price_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->create($request->all());
        return redirect()->route('admin.today-price.index')->with('message' , 'Today Price Create Success!');
    }
    public function show($id)
    {
        abort_if(Gate::denies("today_price_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->findOrFail($id);
        return view('admin.todayPrice.show',compact('today_price'));
    }
    public function edit($id)
    {
        abort_if(Gate::denies("today_price_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->findOrFail($id);
        return view('admin.todayPrice.edit',compact(['today_price']));
    }
    public function update(UpdateTodayPriceRequest $request, $id)
    {
        abort_if(Gate::denies("today_price_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->findOrFail($id);
        $today_price->update($request->all());

        return redirect()->route('admin.today-price.index')->with('message' ,'Today Price Update Successfuly!');
    }

    public function showTrash()
    {
        $today_price = $this->today_price->onlyTrashed()->get();
        return view('admin.todayPrice.trashList', compact('today_price'));
    }

    public function restoreTrash($id)
    {
        $today_price = $this->today_price->withTrashed()->find($id)->restore();
        return redirect()->route('admin.today-price.index')->with('message' , 'Today Price Restore Successfully!');
    }
    public function trashDelete($id)
    {
        $facility = $this->today_price->withTrashed()->find($id);

        if ($facility) {
            $facility->forceDelete();
                return redirect()->route('admin.today-price.showTrash')->with('message',"Trash Data Delete Successfully!");
        } else {
            return redirect()->route('admin.today-price.showTrash')->with("message","Fail");
        }
    }


    public function destroy($id)
    {
        abort_if(Gate::denies("today_price_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $today_price = $this->today_price->findOrFail($id);
        $today_price->delete();
        return redirect()->route('admin.today-price.index')->with('message' ,'Today Price Delete Successfuly!');
    }
}
