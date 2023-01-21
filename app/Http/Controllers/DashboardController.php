<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use BladeHelper;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countRegistration = Service::where('status_service', 'registration');
        $countPaid = Service::where('status_service', 'paid');
        $countCancle = Service::where('status_service', 'cancle');
        $countDone = Service::where('status_service', 'done');

        $nowDate = date('Y-m-d');

        $insightDay = [
            'registration' => $countRegistration->where('created_at', '>', $nowDate)->count(),
            'paid' => $countPaid->where('updated_at', '>', $nowDate)->count(),
            'cancle' => $countCancle->where('updated_at', '>', $nowDate)->count(),
            'done' => $countDone->where('updated_at', '>', $nowDate)->count(),
            'daily' => date('M d, Y'),
            'price' => $countPaid->where('updated_at', '>', $nowDate)->withSum('transactions', 'total_price')->get()->sum('transactions_sum_total_price') ?? 0
        ];


        // return response()->json([
        //     'registration' => $countRegistration->where('created_at', $nowDate)->count(),
        //     'paid' => $countPaid->where('created_at', $nowDate)->count(),
        //     'cancle' => $countCancle->where('created_at', $nowDate)->count(),
        //     'done' => $countDone->where('created_at', $nowDate)->count(),
        //     'date' => $nowDate
        // ]);
        return view('admin.dashboard.index', compact('insightDay'));
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
}
