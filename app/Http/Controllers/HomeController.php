<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function lacak_perbaikan()
    {
        return view('pages.lacak_perbaikan');
    }

    public function find_service(Request $request)
    {
        $service = Service::where('code_service', $request->resi)->first();
        return redirect()->route('show.perbaikan', $service->code_service);
    }

    public function show_perbaikan($code_service)
    {
        $service = Service::where('code_service', $code_service)->first();
        return view('pages.show_perbaikan', compact('service'));
    }
}
