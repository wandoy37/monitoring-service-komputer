@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
            </ul>
        </div>
        {{-- <div class="page-category">
            <h1 class="badge badge-secondary">Today Overview</h1>
        </div> --}}



        <div class="row">
            <div class="col-md-12">
                <div class="my-4">
                    <h1 class="fw-bold text-secondary">Status Your Tasks</h1>
                    <i class="text-muted">Status Pekerjaan Anda</i>
                </div>
                <div class="row row-card-no-pd">
                    <div class="col-sm-2 col-md-2">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category text-warning fw-bold">Check</p>
                                            <h4 class="card-title">{{ $insightDay['check'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category text-warning fw-bold">Repair</p>
                                            <h4 class="card-title">{{ $insightDay['repair'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category text-success fw-bold">Done</p>
                                            <h4 class="card-title">{{ $insightDay['done'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category fw-bold">Pending</p>
                                            <h4 class="card-title">{{ $insightDay['pending'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category fw-bold">Sedang Di Service Center</p>
                                            <h4 class="card-title">{{ $insightDay['service_center'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="fw-bold text-secondary">
                            New Service
                            <span class="badge badge-secondary">{{ $newService->count() }}</span>
                        </h1>
                        <i class="text-muted">Servis baru ditambahkan</i>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-secondary">
                                <tbody>
                                    @foreach ($newService as $service)
                                        <tr class="text-center">
                                            <td>{{ $service->created_at->format('d M, Y') }}</td>
                                            <td>{{ $service->code_service }}</td>
                                            <td>{{ $service->store }}</td>
                                            <td>{{ $service->customer_name }}</td>
                                            <td>{{ $service->customer_phone }}</td>
                                            <td>{{ $service->device }}</td>
                                            <td>
                                                @if ($service->status_service == 'registration')
                                                    <span
                                                        class="text-capitalize badge badge-danger">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'check')
                                                    <span
                                                        class="text-capitalize badge badge-warning">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'repair')
                                                    <span
                                                        class="text-capitalize badge badge-warning">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'done')
                                                    <span
                                                        class="text-capitalize badge badge-primary">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'paid')
                                                    <span
                                                        class="text-capitalize badge badge-success">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'cancle')
                                                    <span
                                                        class="text-capitalize badge badge-count">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'pending')
                                                    <span
                                                        class="text-capitalize badge badge-count">{{ $service->status_service }}</span>
                                                @endif
                                                @if ($service->status_service == 'sedang di service center')
                                                    <span
                                                        class="text-capitalize badge badge-warning">{{ $service->status_service }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-inline">
                                                    <a type="button" href="{{ route('resi.view', $service->id) }}"
                                                        class="btn btn-link btn-info" target="_blank">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                    <a href="{{ route('service.repair', $service->id) }}"
                                                        class="btn btn-link btn-warning">
                                                        <i class="icon-wrench"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
