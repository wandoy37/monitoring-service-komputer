@extends('admin.layouts.app')

@section('title', 'Daftar Service')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Service</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-wrench"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('service.index') }}">Service</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('service.create') }}">Daftar Service</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('service.index') }}" class="btn btn-secondary btn-round btn-border btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">Daftar Service</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('service.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Store <small>(Toko / Cabang)</small></label>
                                        <select class="form-control" name="store">
                                            <option>-- Select Store --</option>
                                            @foreach ($stores as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('store') == $key ? 'selected' : null }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('store')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Customer <small>(Nama Pengguna)</small></label>
                                        <input type="text" name="customer_name"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            placeholder="customer_name" value="{{ old('customer_name') }}">
                                        @error('customer_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number <small>(Nomor Hp)</small></label>
                                        <input type="number" name="customer_phone"
                                            class="form-control @error('customer_phone') is-invalid @enderror"
                                            placeholder="Phone" value="{{ old('customer_phone') }}">
                                        @error('customer_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Device <small>(Perangkat / Laptop)</small></label>
                                        <input type="text" name="device"
                                            class="form-control @error('device') is-invalid @enderror" placeholder="device"
                                            value="{{ old('device') }}">
                                        @error('device')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keluhan</label>
                                        <textarea name="keluhan" class="form-control" cols="30" rows="2"></textarea>
                                        @error('keluhan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-secondary btn-round">
                                            <i class="fas fa-plus"></i>
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
