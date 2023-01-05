<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::where(function ($w) {
            $w->where('status_service', 'done')
                ->orWhere('status_service', 'paid');
        });

        // Filter methods search code_service, customer_name, customer_phone
        if (request('search')) {
            $services = $services->where('code_service', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . request('search') . '%');
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
        return view('admin.transaction.index', compact('services', 'stores', 'statuses', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Get data service
        $service = Service::find($id);

        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
                'description' => 'required',
                'total_price' => 'required',
            ],
            [],
        );

        // Kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Store value data to Table Transactions
        Transaction::create([
            'service_id' => $service->id,
            'category' => $request->category,
            'description' => $request->description ?? null,
            'total_price' => $request->total_price,
        ]);

        // Update status transaction to Service
        $service->update([
            'status_service' => 'paid'
        ]);

        return redirect('/admin/transaction')->with('success', $service->code_service . ' Success Transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        $categories = $this->categories();

        $totals = collect(Arr::pluck($service->additionals, 'price'))->sum();

        return view('admin.transaction.show', compact('service', 'categories', 'totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function categories()
    {
        return [
            'Service Hardware' => 'Service Hardware',
            'Service Software' => 'Service Software',
            'Service Hardware & Software' => 'Service Hardware & Software',
        ];
    }

    public function cetakView(Service $service)
    {
        return view('admin.transaction.page.cetak', compact('service'));
    }

    private function stores()
    {
        return [
            'Ghuftha - Perjuangan' => 'Ghuftha - Perjuangan',
            'Ghuftha - Pelita' => 'Ghuftha - Pelita',
        ];
    }

    private function statuses()
    {
        return [
            'done' => 'done',
            'paid' => 'paid',
        ];
    }
}
