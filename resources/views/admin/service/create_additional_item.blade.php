@extends('admin.layouts.app')

@section('title', 'Service Additional Item')

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
                    <a href="{{ route('create.additional.item', $service->id) }}">Additional Item</a>
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
                        <h4 class="page-title">Additional Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.additional.item', $service->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" name="item"
                                    class="form-control @error('item') is-invalid @enderror" placeholder="Item...">
                                @error('item')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">IDR</span>
                                    </div>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror" placeholder="Price..">
                                </div>
                                @error('price')
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
