<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ghuftha Komputer - Lacak Perbaikan</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="http://monitoring-service-komputer.test/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="http://monitoring-service-komputer.test/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['http://monitoring-service-komputer.test/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="http://monitoring-service-komputer.test/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://monitoring-service-komputer.test/assets/css/atlantis.css">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center" style="padding-top: 10%;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2 class="text-secondary">Ghuftha Komputer</h2>
                                <span>Samarinda, Kalimantan - Timur</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right">
                                    <h3 class="text-muted">{{ $service->code_service }}</h3>
                                </div>
                            </div>

                            <div class="col-sm-12" style="padding-top: 50px;">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Toko / Cabang</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Device</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">{{ $service->store }}</td>
                                            <td class="text-center">{{ $service->customer_name }}</td>
                                            <td class="text-center">{{ $service->device }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="my-2">
                                    <div class="form-group">
                                        <strong>Keluhan :</strong>
                                        <p>{{ $service->keluhan }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <strong>Lacak Perbaikan</strong>
                                <ol class="activity-feed">
                                    <li class="feed-item feed-item-info">
                                        <time class="date"
                                            datetime="9-25">{{ $service->created_at->format('M d') }}</time>
                                        <span class="text"><b>Registration</b>
                                            <p>Perangkat anda sedang dalam antrian</p>
                                        </span>
                                    </li>
                                    @foreach ($service->activities as $activity)
                                        <li class="feed-item feed-item-info">
                                            <time class="date"
                                                datetime="9-25">{{ $activity->created_at->format('M d') }}</time>
                                            <span class="text-capitalize"><b>{{ $activity->status }}</b>
                                                <p>{{ $activity->description }}</p>
                                            </span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <a href="{{ route('lacak.perbaikan') }}" class="btn btn-secondary btn-round">Back</a>
            </div>
        </div>
    </div>

    <script src="http://monitoring-service-komputer.test/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="http://monitoring-service-komputer.test/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js">
    </script>
    <script src="http://monitoring-service-komputer.test/assets/js/core/popper.min.js"></script>
    <script src="http://monitoring-service-komputer.test/assets/js/core/bootstrap.min.js"></script>
    <script src="http://monitoring-service-komputer.test/assets/js/atlantis.min.js"></script>
</body>

</html>
