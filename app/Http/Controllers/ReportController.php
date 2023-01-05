<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // filter value
        $filters = [];

        // Get all service (registration, done, paid)
        $reports = Service::where(function ($w) {
            $w->where('status_service', 'registration')
                ->orWhere('status_service', 'done')
                ->orWhere('status_service', 'paid')
                ->orWhere('status_service', 'cancle');
        });

        // Filters methods star date to end date
        if (request('start_date') && request('end_date')) {
            $start = request('start_date');
            $end = request('end_date');

            $reports = $reports->whereDate('created_at', '<=', $end)
                ->whereDate('created_at', '>=', $start);
        }

        // Filter methods search code_service, customer_name, customer_phone
        if (request('search')) {
            $reports = $reports->where('code_service', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . request('search') . '%');
        }

        // Filter methods select store atau cabang
        if (request('store')) {
            $reports = $reports->where('store', 'LIKE', '%' . request('store') . '%');
        }

        // Filter methods select status atau status
        if (request('status')) {
            $reports = $reports->where('status_service', 'LIKE', '%' . request('status') . '%');
        }

        $profits = $reports->withSum('transactions', 'total_price')->get()->sum('transactions_sum_total_price') ?? 0;

        $reports = $reports->orderBy('created_at', 'DESC')->paginate(10);

        // get request filter value
        $filters = [
            'search' => $request->search ?? '',
            'start_date' => $request->start_date ?? '',
            'end_date' => $request->end_date ?? '',
            'store' => $request->store ?? '',
            'status' => $request->status ?? '',
        ];

        $stores = $this->stores();
        $statuses = $this->statuses();

        // return response()->json($reports->get());
        return view('admin.report.index', compact('reports', 'profits', 'stores', 'statuses', 'filters'));
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
    public function store(Request $request)
    {
        //
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
            'registration' => 'registration',
            'done' => 'done',
            'paid' => 'paid',
            'cancle' => 'cancle',
        ];
    }
}
