<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pt Bersama Auto Mobilindo | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/ekko-lightbox/ekko-lightbox.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins')}}/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist')}}/css/adminlte.min.css">

    <link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">

    <style>
        .btn-sign-out {
            width: 15%;
            position: fixed;
            bottom: 10px; /* Jarak dari bawah (sesuaikan sesuai kebutuhan) */
            color: #ffffff; /* Warna teks tombol */
            padding: 10px 20px; /* Padding tombol (sesuaikan sesuai kebutuhan) */
            border: none; /* Hapus batas tombol jika tidak diinginkan */
            border-radius: 5px; /* Sudut sudut tombol (sesuaikan sesuai kebutuhan) */
            cursor: pointer;
        }
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{asset('dist')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- NAVBAR -->
    @include('layouts.partials._navbar')

    <!-- SIDEBAR -->
    @include('layouts.partials._sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('layouts.partials._footer')

    <!-- jQuery -->
    <script src="{{asset('plugins')}}/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins')}}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist')}}/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset('plugins')}}/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{asset('plugins')}}/raphael/raphael.min.js"></script>
    <script src="{{asset('plugins')}}/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{asset('plugins')}}/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins')}}/chart.js/Chart.min.js"></script>
    <!-- <script src="{{asset('dist')}}/js/pages/dashboard2.js"></script> -->

    <!-- Bootstrap 4 -->
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/jszip/jszip.min.js"></script>
    <script src="{{asset('plugins')}}/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('plugins')}}/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('plugins')}}/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let origin = window.location.origin
        let pathname = window.location.pathname
            pathname = pathname.split('/')
        let path = pathname[1]

        if (window.location.pathname != '/') {

            $('.nav-link').removeClass('active')
        }
        $('.nav-link').each(function() {
            var linkUrl = $(this).attr('href');
            if (`${origin}/${path}` === linkUrl) {
                if ($(this).data('child') == 1) {
                    $(this).closest('.nav-item-parent').addClass('menu-open');
                }
                $(this).addClass('active');
            }
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        })
    </script>
    @yield('script')
</body>
</html>
