@extends('admin.layouts.app')

@section('title', 'Add Service Activity')

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
                    <a href="{{ route('service.repair', $service->id) }}">Repair</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('create.activity', $service->id) }}">Activity</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12 my-4">
                <a href="{{ route('service.repair', $service->id) }}" class="btn btn-secondary btn-round btn-border btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">Activity</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.activity', $service->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">-- Select Status --</option>
                                    @foreach ($statuses as $key => $value)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : null }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-secondary btn-round">
                                    <i class="fas fa-plus"></i>
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
