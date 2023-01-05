@extends('admin.transaction.page.app')

@section('title', 'Cetak Transaction')

@section('content')
    <section id="cetakResi">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 info-invoice">
                                <div class="invoice-header">
                                    <div>
                                        <h3>No. Transaction</h3>
                                        {{ $service->code_service }}
                                    </div>
                                    <div class="invoice-title">
                                        <h1 class="invoice-title">
                                            <strong class="text-secondary">Ghufta Komputer</strong>
                                            <br />
                                            <small>
                                                Samarinda, Kalimantan - Timur<br />
                                                Fax (+62) 821 4872 2747
                                            </small>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{-- Information Customer --}}
                                <div class="row text-center my-4">
                                    <div class="col-sm-4">Name</div>
                                    <div class="col-sm-4">Date Transaction</div>
                                    <div class="col-sm-4">Device</div>
                                    <div class="col-sm-4"><strong>{{ $service->customer_name }}</strong></div>
                                    <div class="col-sm-4">
                                        <strong>{{ $service->transactions->created_at->format('Y M, d') }}</strong>
                                    </div>
                                    <div class="col-sm-4"><strong>{{ $service->device }}</strong></div>
                                </div>
                                <div class="invoice-detail">
                                    <div class="invoice-item">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Item</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"><strong>Price</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($service->additionals as $items)
                                                        <tr>
                                                            <td>{{ $items->item }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">@currency($items->price)</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"><strong>Total</strong></td>
                                                        <td class="text-center"><strong>@currency($service->additionals->sum('price'))</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"><strong>Payment Type</strong></td>
                                                        <td class="text-center"><strong>CASH</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p><strong>NOTE :</strong> {{ $service->transactions->description }}</p>
                            </div>
                            <div class="col-sm-12 text-center my-2">
                                <i>
                                    Ghuftha Komputer mengucapkan,
                                    Terimakasih sudah mempercayakan kami untuk mengatasi masalah perangkat anda.
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        window.print();
    </script>
@endpush
