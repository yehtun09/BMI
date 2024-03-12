<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeStatusRequest;
use App\Http\Requests\updateStatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    protected $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        abort_if(Gate::denies("status_access"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $statuses = $this->status->all();
        return view('admin.status.index', compact('statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies("status_create"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        return view('admin.status.create');
    }

    public function store(storeStatusRequest $request)
    {
        $this->status->create($request->all());
        return redirect()->route('admin.status-all.index')->with('message', 'Status created successfully!');
    }

    public function show($id)
    {
        abort_if(Gate::denies("status_show"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $status = $this->status->findOrFail($id);
        return view('admin.status.show', compact('status'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies("status_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $status = $this->status->findOrFail($id);
        // Add logic to fetch additional data if needed
        return view('admin.status.edit', compact('status'));
    }

    public function update(updateStatusRequest $request, $id)
    {
        abort_if(Gate::denies("status_edit"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $status = $this->status->findOrFail($id);
        $status->update($request->all());
        return redirect()->route('admin.status-all.index')->with('message', 'Status updated successfully!');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("status_delete"), Response::HTTP_FORBIDDEN, "403 Forbidden");
        $status = $this->status->findOrFail($id);
        $status->delete();
        return redirect()->route('admin.status-all.index')->with('message', 'Status deleted successfully!');
    }
}
