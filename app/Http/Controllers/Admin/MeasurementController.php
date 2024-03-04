<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeasurementRequest;
use App\Http\Requests\UpdateMeasurementRequest;
use App\Models\Measurement;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MeasurementController extends Controller
{
    protected $measurements;
    public function __construct( Measurement $measurements,ProductCategory $product_categories)
    {
       $this->middleware("auth");
       $this->measurements = $measurements;
       $this->product_categories = $product_categories;
   }  
    
    public function index()
    {
        
        abort_if(Gate::denies('measurement_access'),Response::HTTP_FORBIDDEN, '403 Forbidden');
        $measurements = $this->measurements->with('productCategory')->get();
        return view("admin.measurement.index", compact("measurements"));
    }
    
    public function create()
    {
        abort_if(Gate::denies("measurement_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurements = $this->measurements->all();
        $product_categories = $this->product_categories->all();
        return view('admin.measurement.create',compact(['measurements','product_categories']));
    }
   
    public function store(StoreMeasurementRequest $request)
    {
        abort_if(Gate::denies("measurement_create"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurement = $this->measurements->create($request->all());
        return redirect()->route('admin.measurement.index')->with('message','Measurement Create Success!');
    }
    
    public function show($id)
    {
        abort_if(Gate::denies("measurement_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurement = $this->measurements->with('productCategory')->findOrFail($id);
       
        return view('admin.measurement.show',compact('measurement'));
    }
    
    public function edit($id)
    {
        abort_if(Gate::denies("measurement_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurement = $this->measurements->findOrFail($id);
        $product_categories = $this->product_categories->all();
        return view('admin.measurement.edit',compact(['measurement','product_categories']));
    }

    
    public function update(UpdateMeasurementRequest $request, $id)
    {
       
        abort_if(Gate::denies("measurement_edit"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurement = $this->measurements->findOrFail($id);
        $measurement->update($request->all());
        return redirect()->route('admin.measurement.index')->with('message','Measurement Update Success!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("measurement_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $measurement = $this->measurements->findOrFail($id);
        $measurement->delete();
        return redirect()->route('admin.measurement.index')->with('message','Measurement Delete Successfuly!');
    }
}
