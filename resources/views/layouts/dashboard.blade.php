<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard ZIS Al-Iman</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="stylesheet" href="{{asset('css/lib/datatable/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet"/>
</head>

<body>
@auth()
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel ">
        <nav class="navbar navbar-expand-sm navbar-default ">
            <div id="main-menu" class="main-menu collapse navbar-collapse ">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('home')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Action</li><!-- /.menu-title -->
                    @auth()
                        @if(auth()->user()->role == 'Admin' || (auth()->user()->role == 'Ketua'))
                            <li class="menu-item">
                                <a href="{{route('pengguna.index')}}" class="nav-item" aria-haspopup="true"
                                   aria-expanded="false"> <i class="menu-icon fa ti-id-badge"></i>Pengguna</a>
                            </li>
                        @endif
                        {{--                        @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'Ketua' || auth()->user()->role == 'Bendahara' || auth()->user()->role == 'Sekertaris')--}}
                        {{--                            <li class="menu-item">--}}
                        {{--                                <a href="{{route('jeniszis.index')}}" class="nav-item" aria-haspopup="true"--}}
                        {{--                                   aria-expanded="false"> <i class="menu-icon fa ti-agenda"></i>Jenis ZIS</a>--}}
                        {{--                            </li>--}}
                        {{--                        @endif--}}
                        @if(auth()->user()->role == 'Admin' || auth()->user()->role != 'Jamaah' || auth()->user()->role == 'PanitiaRamadhan')
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false"> <i class="menu-icon fa ti-files"></i>Entri Jenis ZIS</a>
                                <ul class="sub-menu children dropdown-menu">
                                    @endif
                                    @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'Ketua' || auth()->user()->role == 'Bendahara' || auth()->user()->role == 'Sekertaris')
                                        <li><i class="fa ti-agenda"></i><a href="{{route('jeniszis.index')}}">Jenis
                                                ZIS</a></li>
                                    @endif
                                    @if(auth()->user()->role == 'Admin' || auth()->user()->role != 'Jamaah' || auth()->user()->role == 'PanitiaRamadhan')
                                        <li><i class="fa fa-money"></i><a href="{{route('pemasukan.index')}}">Pemasukan
                                                Jenis</a></li>
                                        <li><i class="fa ti-shopping-cart"></i><a href="{{route('pengeluaran.index')}}">Pengeluaran
                                                Jenis</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(auth()->user()->role == 'Admin' || auth()->user()->role != 'Jamaah' || auth()->user()->role == 'PanitiaRamadhan')
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false"> <i class="menu-icon fa fa-calendar-o"></i>Entri Barang ZIS</a>
                                <ul class="sub-menu children dropdown-menu">
                                    @endif
                                    @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'Ketua' || auth()->user()->role == 'Bendahara' || auth()->user()->role == 'Sekertaris')
                                        <li>
                                            <i class="ti ti-package"></i><a href="{{route('bentukzis.index')}}">Barang
                                                ZIS</a>
                                        </li>
                                    @endif
                                    @if(auth()->user()->role == 'Admin' || auth()->user()->role != 'Jamaah' || auth()->user()->role == 'PanitiaRamadhan')
                                        <li><i class="fa fa-money"></i><a href="{{route('pemasukan-bentuk.index')}}">Pemasukan
                                                Barang</a></li>
                                        <li><i class="fa fa-shopping-cart"></i><a
                                                href="{{route('pengeluaran-bentuk.index')}}">Pengeluaran
                                                Barang</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                    <li class="menu-item">
                        <a href="{{route('laporan.index')}}" aria-haspopup="true"
                           aria-expanded="false"> <i class="menu-icon fa ti-envelope"></i>Rekap/Laporan</a>
                    </li>
                    @auth()
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Data Jamaah</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><a href="{{route('dasa_wisma.index')}}">Dasawisma</a></li>
                                <li><a href="{{route('RT.index')}}">RT</a></li>
                                <li><a href="{{route('warga.index')}}">Warga</a></li>
                                <li><a href="{{route('jenis_kelamin.index')}}">Jenis Kelamin</a></li>
                                <li><a href="{{route('golongan_darah.index')}}">Gol Darah</a></li>
                                <li><a href="{{route('jamaah.index')}}">Jamaah</a></li>
                            </ul>
                        </li>
                    @endauth
                    @auth()
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"> <i class="menu-icon fa fa-book"></i>TPA</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><a href="{{route('santri.index')}}">Santri</a></li>
                                <li><a href="{{route('sekolah.index')}}">Sekolah</a></li>
                                <li><a href="{{route('iqro.index')}}">Iqro</a></li>
{{--                                <li><a href="{{route('santri.pencapaian')}}">Al-Quran</a></li>--}}
                                <li><a href="{{route('juz.index')}}">Juz</a></li>
                                <li><a href="{{route('nilai.index')}}">Nilai</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
@endauth
<!-- Right Panel -->
<div id="right-panel" class="right-panel @guest guest @endguest">
    <!-- Header-->
    <header id="header" class="header ">
        <div class="top-left">
            <div class="navbar-header  ">
                <a class="@guest mt-2 @endguest" style="font-size: 22px;font-weight: 600" href="/"><span
                        class="text-dark">ZIS</span> <span class="text-success"> Al-Iman</span></a>
                <a class="navbar-brand hidden " href="./"></a>
                @auth()<a id="menuToggle" class="menutoggle ml-lg-5"><i class="fa fa-bars"></i></a>@endauth
            </div>
        </div>

        <div class="top-right">
            <div class="header-menu">
                @auth()
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                       aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>

                            </button>

                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>

                            </button>

                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="fa fa-user-circle"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>


                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>

                            <a class="nav-link" href="{{route('logout')}}"
                               onclick="event.preventDefault();document.getElementById('formlogout').submit();"><i
                                    class="fa fa-power-off"></i>Logout</a>
                            <form id="formlogout" action="{{route('logout')}}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </header>
    <!-- /#header -->
    @yield('content')
    <div class="clearfix"></div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2018 Ela Admin
                </div>
                <div class="col-sm-6 text-right">
                    Designed by <a href="https://colorlib.com">Colorlib</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<script src="{{asset('js/chart.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="{{asset('js/init/fullcalendar-init.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

@if(session('error-create'))
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function () {
                $('#createmodal').modal('show')
            })
        })
    </script>
@endif
@if(session('error-update'))
    <script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function () {
                $('#editmodal-{{session('id')}}').modal('show')
            })
        })
    </script>
@endif

</body>
</html>
