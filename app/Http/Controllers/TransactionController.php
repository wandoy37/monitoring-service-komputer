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
    public function index()
    {
        $services = Service::where('status_service', 'done')->get()->all();
        // return response()->json($services);
        $search = [];
        return view('admin.transaction.index', compact('services', 'search'));
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
            'status_transaction' => 'paid'
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

    public function cetakView()
    {
        //
    }
}
