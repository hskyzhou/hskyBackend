<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
  <!--<![endif]-->
  <!-- BEGIN HEAD -->
  <head>
    <meta charset="utf-8" />
    <title>{{$title or ''}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('themes/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('themes/metronic/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('themes/metronic/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('themes/metronic/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('themes/metronic/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    @yield('css')
    <link href="{{asset('themes/metronic/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
  </head>
  <!-- END HEAD -->

  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <!-- BEGIN HEADER -->
    @include('themes.metronic.common.head')
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        @include('themes.metronic.common.sidebar')
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
          <!-- BEGIN CONTENT BODY -->
          <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
            @include('themes.metronic.common.theme')
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            @include('themes.metronic.common.breadcrumb')
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            @yield('content')
          </div>
          <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    @include('themes.metronic.common.foot')
    <!-- END FOOTER -->
    <!--[if lt IE 9]>
        <script src="{{asset('themes/metronic/global/plugins/respond.min.js')}}"></script>
        <script src="{{asset('themes/metronic/global/plugins/excanvas.min.js')}}"></script> 
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('themes/metronic/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('themes/metronic/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('themes/metronic/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('themes/metronic/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('themes/metronic/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/metronic/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    @yield('js')
  </body>
</html>