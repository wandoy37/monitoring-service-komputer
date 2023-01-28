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
        <div class="row justify-content-center" style="padding-top: 15%;">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body text-center">
                        <h2>Lacak Perbaikan</h2>
                        <form action="{{ route('find.service.process') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" name="resi" placeholder="Nomor Resi ...">
                            <div class="my-2">
                                <button type="submit" class="btn btn-secondary btn-round">Lacak</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
            </div>
            <div class="col-lg-8">
                <h2>Syarat & Ketentuan</h2>
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
