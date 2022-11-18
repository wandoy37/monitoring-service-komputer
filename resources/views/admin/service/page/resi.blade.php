@extends('admin.service.page.app')

@section('title', 'Cetak Resi')

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
                                        <h3>No. Resi</h3>
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
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date Registration</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Contact Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $service->created_at->format('M d, Y') }}</td>
                                            <td>{{ $service->customer_name }}</td>
                                            <td>{{ $service->customer_phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <strong>Keluhan :</strong> {{ $service->keluhan }}
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-12 text-center mb-4 text-muted">
                                <strong>*NOTE :</strong> Pengambilan perangkat yang di service maksimal 2 minggu setelah
                                dikonfirmasi, lebih dari itu kami tidak bertanggung jawab jika terjadi sesuatu pada
                                perangkat anda.
                            </div>
                            <div class="col-4">
                                <h6 class="text-capitalize text-center mb-4 fw-bold">
                                    Menyetujui,
                                </h6>
                                <br class="my-4">
                                <div class="separator-solid"></div>
                            </div>
                            <div class="col-12">
                                <p class="text-center mt-0">Anda dapat memantau status perbaikan pada link
                                    <a href="http://ghuftacomputers.com/cek-resi/">ghuftacomputers.com/cek-resi/</a>
                                </p>
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
