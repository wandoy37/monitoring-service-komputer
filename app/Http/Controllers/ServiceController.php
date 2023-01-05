<?php

namespace App\Http\Controllers;

use App\Models\AdditionalItems;
use App\Models\Service;
use App\Models\ServiceActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::where(function ($w) {
            $w->where('status_service', 'registration')
                ->orWhere('status_service', 'check')
                ->orWhere('status_service', 'repair')
                ->orWhere('status_service', 'done')
                ->orWhere('status_service', 'cancle');
        });

        // Filter methods search code_service, customer_name, customer_phone
        if (request('search')) {
            $services = $services->where('code_service', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . request('search') . '%');
        }

        // Filters methods star date to end date
        if (request('start_date') && request('end_date')) {
            $start = request('start_date');
            $end = request('end_date');

            $services = $services->whereDate('created_at', '<=', $end)
                ->whereDate('created_at', '>=', $start);
        }

        // Filter methods select store atau cabang
        if (request('store')) {
            $services = $services->where('store', 'LIKE', '%' . request('store') . '%');
        }

        // Filter methods select status atau status
        if (request('status')) {
            $services = $services->where('status_service', 'LIKE', '%' . request('status') . '%');
        }

        // Data Stores
        $stores = $this->stores();
        // Data Statuses
        $statuses = $this->statuses();

        // Get service berdasarkan kondisi yang ada
        $services = $services->orderBy('created_at', 'DESC')->paginate(10);

        // get request filter value
        $filters = [
            'search' => $request->search ?? '',
            'start_date' => $request->start_date ?? '',
            'end_date' => $request->end_date ?? '',
            'store' => $request->store ?? '',
            'status' => $request->status ?? '',
        ];
        return view('admin.service.index', compact('services', 'statuses', 'stores', 'filters'));
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

        // Last data
        $lastService = Service::all()->count();
        $lastService++;


        // Jika berhasil melewati validator maka tangkap datanya
        $service = Service::create([
            'code_service' => 'SRV-' . date('Ymd') . '-' . str_pad($lastService, 4, '0', STR_PAD_LEFT),
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
        $technicals = User::all();
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
            'Ghuftha - Perjuangan' => 'Ghuftha - Perjuangan',
            'Ghuftha - Pelita' => 'Ghuftha - Pelita',
        ];
    }

    public function resiView(Service $service)
    {
        return view('admin.service.page.resi', compact('service'));
    }

    public function repair($id)
    {
        $service = Service::find($id);
        $stores = $this->stores();
        return view('admin.service.repair', compact('service', 'stores'));
    }

    public function create_activity($id)
    {
        $service = Service::find($id);
        $statuses = $this->statuses();
        return view('admin.service.create_activity', compact('service', 'statuses'));
    }

    public function store_activity(Request $request, $id)
    {
        // Get ID Service
        $serviceId = Service::find($id);

        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required',
                'description' => 'required',
            ],
            $messages = [
                'status.required' => 'Status tidak boleh kosong.!',
                'description.required' => 'Description tidak boleh kosong.!',
            ],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Update status service
        $serviceId->update([
            'status_service' => $request->status,
            'technical_id' => Auth::user()->id
        ]);

        $data = [
            'status' => $request->status,
            'description' => $request->description,
            'service_id' => $serviceId->id,
            'technical_id' => Auth::user()->id
        ];

        ServiceActivity::create($data);

        return redirect(route('service.repair', $serviceId->id))->with('success', 'Service Activity berhasil di tambahkan');
    }

    public function create_additional_item($id)
    {
        $service = Service::find($id);
        return view('admin.service.create_additional_item', compact('service'));
    }

    public function store_additional_item(Request $request, $id)
    {
        // Get ID Service
        $serviceId = Service::find($id);

        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'item' => 'required',
                'price' => 'required',
            ],
            $messages = [
                'item.required' => 'Item tidak boleh kosong.!',
                'price.required' => 'Price tidak boleh kosong.!',
            ],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $data = [
            'item' => $request->item,
            'price' => $request->price,
            'service_id' => $serviceId->id
        ];

        AdditionalItems::create($data);
        return redirect(route('service.repair', $serviceId->id))->with('success', 'Additional item berhasil di tambahkan');
    }
}
