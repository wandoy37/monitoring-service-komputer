<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id', 'DESC')->get();
        // Mencari data berdasarkan service_code search
        if (request('search')) {
            $services = Service::where('code_service', 'LIKE', '%' . request('search') . '%')->get();
        }
        // Jika terdapat nilai code_service
        $search = request('search') ?? '';

        // Mencari data berdasarkan status_service 
        if (request('status')) {
            $services = Service::where('status_service', 'LIKE', '%' . request('status') . '%')->get();
        }
        // Jika terdapat nilai status_service
        $status = request('status') ?? '';

        $statuses = $this->statuses();
        return view('admin.service.index', compact('services', 'statuses', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = $this->stores();
        return view('admin.service.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'customer_name' => 'required',
                'customer_phone' => 'required',
                'device' => 'required',
                'keluhan' => 'required',
                'store' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Jika berhasil melewati validator maka tangkap datanya
        $service = Service::create([
            'code_service' => 'SRV-' . date('Ymd') . '-' . rand(1000, 9999),
            'status_service' => 'registration',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'device' => $request->device,
            'keluhan' => $request->keluhan,
            'store' => $request->store,
        ]);

        // Kembali ke list data service
        return redirect('/admin/service')->with('success', 'Berhasil mendaftarkan service baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $stores = $this->stores();
        $statuses = $this->statuses();
        $technicals = User::whereRole('teknisi')->get();
        return view('admin.service.edit', compact('service', 'stores', 'statuses', 'technicals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'customer_name' => 'required',
                'customer_phone' => 'required',
                'device' => 'required',
                'keluhan' => 'required',
                'store' => 'required',
                'status_service' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Jika lolos validator
        $data = [
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'device' => $request->device,
            'keluhan' => $request->keluhan,
            'store' => $request->store,
            'status_service' => $request->status_service,
        ];

        if (request('technical_id')) {
            $data['technical_id'] = $request->technical_id;
        }

        // update data service
        $service->update($data);
        // Kembali ke list data service
        return redirect('/admin/service')->with('success', 'Berhasil melakukan update pada code service : ' . $service->code_service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        $service->delete();
        return redirect('/admin/service')->with('success', 'Berhasil menghapus data service ' . $service->code_service);
    }

    private function statuses()
    {
        return [
            'registration' => 'registration',
            'check' => 'check',
            'repair' => 'repair',
            'done' => 'done',
            'cancle' => 'cancle',
        ];
    }

    private function stores()
    {
        return [
            'Ghufta - Perjuangan' => 'Ghufta - Perjuangan',
            'Ghufta - Pelita' => 'Ghufta - Pelita',
        ];
    }

    public function resiView(Service $service)
    {
        return view('admin.service.page.resi', compact('service'));
    }
}
