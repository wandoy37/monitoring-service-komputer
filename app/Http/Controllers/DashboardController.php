<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use BladeHelper;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\NullType;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
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

            return view('admin.dashboard.index', compact('insightDay'));
        }

        if (Auth::user()->role == 'teknisi') {
            // Current Date
            $nowDate = date('Y-m-d');

            // On Repairs Countinue
            $countCheck = Service::where('status_service', 'check');
            $countRepair = Service::where('status_service', 'repair');
            $countDone = Service::where('status_service', 'done');
            $countPending = Service::where('status_service', 'pending');
            $countServiceCenter = Service::where('status_service', 'sedang di service center');
            $countDone = Service::where(function ($w) {
                $w->where('status_service', 'done')
                    ->orWhere('status_service', 'paid');
            });

            $insightDay = [
                'check' => $countCheck->where('technical_id', Auth::user()->id)->count(),
                'repair' => $countRepair->where('technical_id', Auth::user()->id)->count(),
                'pending' => $countPending->where('technical_id', Auth::user()->id)->count(),
                'service_center' => $countServiceCenter->where('technical_id', Auth::user()->id)->count(),
                'done' => $countDone->where('technical_id', Auth::user()->id)->count(),
                'daily' => date('M d, Y'),
            ];

            // New Service Registration
            $newService = Service::where(function ($w) {
                $w->where('status_service', 'registration')
                    ->orWhere('technical_id', null);
            })->where('store', Auth::user()->store)->orderBy('id', 'DESC')->paginate(10);

            return view('admin.dashboard.index2', compact('insightDay', 'newService'));
        }
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
