<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuditLogsController extends Controller
{
    public function index(){
        // abort_if(Gate::denies("users_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $auditlogs=AuditLog::all();
        return  response()->json([
            "code" => 200,
            "message"=> 'AuditLogs successfully!',
            "data" => $auditlogs,
        ],200);
    }
}
