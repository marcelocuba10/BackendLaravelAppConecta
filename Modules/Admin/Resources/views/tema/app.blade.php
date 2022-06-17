<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<!-- http://webapplayers.com/inspinia_admin-v2.9.4 -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRUD | {{ config('app.name')}}</title>
    <link href="/tema/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tema/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/tema/css/custom.css" rel="stylesheet">
    <link href="/tema/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="/tema/js/plugins/dataTables/datatables.min.js" rel="stylesheet">
    <link href="/tema/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/tema/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="/tema/css/animate.css" rel="stylesheet">
    <link href="/tema/css/style.css" rel="stylesheet">
    <link href="/tema/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/tema/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="/tema/css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">

    <!-- orris -->
    <link href="/tema/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

</head>

<body class="md-skin">
    <div id="wrapper">

        @include('admin::tema.sidebar')

        <div id="page-wrapper" class="gray-bg">

            @include('admin::includes.alerts')

            @include('admin::tema.nav')

            @yield('content')

        </div>
    </div>

    <!-- Morris -->
    <script src="/tema/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="/tema/js/plugins/morris/morris.js"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="/tema/js/inspinia.js"></script>
    <script src="/tema/js/plugins/pace/pace.min.js"></script>
    
    <!-- Morris demo data-->
    <script src="/tema/js/demo/morris-demo.js"></script>

    <script src="/tema/js/plugins/select2/select2.full.min.js"></script>
    <script src="/tema/js/jquery-3.1.1.min.js"></script>
    <script src="/tema/js/popper.min.js"></script>
    <script src="/tema/js/bootstrap.js"></script>
    <script src="/tema/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/tema/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/tema/js/plugins/flot/jquery.flot.js"></script>
    <script src="/tema/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/tema/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/tema/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/tema/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/tema/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/tema/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/tema/js/demo/peity-demo.js"></script>
    <script src="/tema/js/inspinia.js"></script>
    <script src="/tema/js/plugins/pace/pace.min.js"></script>
    <script src="/tema/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/tema/js/plugins/gritter/jquery.gritter.min.js"></script>
    <script src="/tema/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="/tema/js/demo/sparkline-demo.js"></script>
    <script src="/tema/js/plugins/chartJs/Chart.min.js"></script>
    <script src="/tema/js/plugins/toastr/toastr.min.js"></script>
    <script src="/tema/js/plugins/dataTables/datatables.min.js"></script>
    <script src="/tema/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <script>
        // Config box
    
        // Enable/disable fixed top navbar
        $('#fixednavbar').click(function (){
            if ($('#fixednavbar').is(':checked')){
                $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
                $("body").removeClass('boxed-layout');
                $("body").addClass('fixed-nav');
                $('#boxedlayout').prop('checked', false);
    
                if (localStorageSupport){
                    localStorage.setItem("boxedlayout",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar",'on');
                }
                
            } else{
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav');
                $("body").removeClass('fixed-nav-basic');
                $('#fixednavbar2').prop('checked', false);
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar2",'off');
                }
            }
        });
    
        // Enable/disable fixed top navbar
        $('#fixednavbar2').click(function (){
            if ($('#fixednavbar2').is(':checked')){
                $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
                $("body").removeClass('boxed-layout');
                $("body").addClass('fixed-nav').addClass('fixed-nav-basic');
                $('#boxedlayout').prop('checked', false);
    
                if (localStorageSupport){
                    localStorage.setItem("boxedlayout",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar2",'on');
                }
            } else {
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav').removeClass('fixed-nav-basic');
                $('#fixednavbar').prop('checked', false);
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar2",'off');
                }
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar",'off');
                }
            }
        });
    
        // Enable/disable fixed sidebar
        $('#fixedsidebar').click(function (){
            if ($('#fixedsidebar').is(':checked')){
                $("body").addClass('fixed-sidebar');
                $('.sidebar-collapse').slimScroll({
                    height: '100%',
                    railOpacity: 0.9
                });
    
                if (localStorageSupport){
                    localStorage.setItem("fixedsidebar",'on');
                }
            } else{
                $('.sidebar-collapse').slimScroll({destroy: true});
                $('.sidebar-collapse').attr('style', '');
                $("body").removeClass('fixed-sidebar');
    
                if (localStorageSupport){
                    localStorage.setItem("fixedsidebar",'off');
                }
            }
        });
    
        // Enable/disable collapse menu
        $('#collapsemenu').click(function (){
            if ($('#collapsemenu').is(':checked')){
                $("body").addClass('mini-navbar');
                SmoothlyMenu();
    
                if (localStorageSupport){
                    localStorage.setItem("collapse_menu",'on');
                }
    
            } else{
                $("body").removeClass('mini-navbar');
                SmoothlyMenu();
    
                if (localStorageSupport){
                    localStorage.setItem("collapse_menu",'off');
                }
            }
        });
    
        // Enable/disable boxed layout
        $('#boxedlayout').click(function (){
            if ($('#boxedlayout').is(':checked')){
                $("body").addClass('boxed-layout');
                $('#fixednavbar').prop('checked', false);
                $('#fixednavbar2').prop('checked', false);
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav');
                $("body").removeClass('fixed-nav-basic');
                $(".footer").removeClass('fixed');
                $('#fixedfooter').prop('checked', false);
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixednavbar2",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixedfooter",'off');
                }
    
    
                if (localStorageSupport){
                    localStorage.setItem("boxedlayout",'on');
                }
            } else{
                $("body").removeClass('boxed-layout');
    
                if (localStorageSupport){
                    localStorage.setItem("boxedlayout",'off');
                }
            }
        });
    
        // Enable/disable fixed footer
        $('#fixedfooter').click(function (){
            if ($('#fixedfooter').is(':checked')){
                $('#boxedlayout').prop('checked', false);
                $("body").removeClass('boxed-layout');
                $(".footer").addClass('fixed');
    
                if (localStorageSupport){
                    localStorage.setItem("boxedlayout",'off');
                }
    
                if (localStorageSupport){
                    localStorage.setItem("fixedfooter",'on');
                }
            } else{
                $(".footer").removeClass('fixed');
    
                if (localStorageSupport){
                    localStorage.setItem("fixedfooter",'off');
                }
            }
        });
    
        // SKIN Select
        $('.spin-icon').click(function (){
            $(".theme-config-box").toggleClass("show");
        });
    
        // Default skin
        $('.s-skin-0').click(function (){
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-2");
            $("body").removeClass("skin-3");
        });
    
        // Blue skin
        $('.s-skin-1').click(function (){
            $("body").removeClass("skin-2");
            $("body").removeClass("skin-3");
            $("body").addClass("skin-1");
        });
    
        // Inspinia ultra skin
        $('.s-skin-2').click(function (){
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-3");
            $("body").addClass("skin-2");
        });
    
        // Yellow skin
        $('.s-skin-3').click(function (){
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-2");
            $("body").addClass("skin-3");
        });
    
        if (localStorageSupport){
            var collapse = localStorage.getItem("collapse_menu");
            var fixedsidebar = localStorage.getItem("fixedsidebar");
            var fixednavbar = localStorage.getItem("fixednavbar");
            var fixednavbar2 = localStorage.getItem("fixednavbar2");
            var boxedlayout = localStorage.getItem("boxedlayout");
            var fixedfooter = localStorage.getItem("fixedfooter");
    
            if (collapse == 'on'){
                $('#collapsemenu').prop('checked','checked')
            }
            if (fixedsidebar == 'on'){
                $('#fixedsidebar').prop('checked','checked')
            }
            if (fixednavbar == 'on'){
                $('#fixednavbar').prop('checked','checked')
            }
            if (fixednavbar2 == 'on'){
                $('#fixednavbar2').prop('checked','checked')
            }
            if (boxedlayout == 'on'){
                $('#boxedlayout').prop('checked','checked')
            }
            if (fixedfooter == 'on') {
                $('#fixedfooter').prop('checked','checked')
            }
        }
    </script>
    
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            let toast = $('.toast');

            setTimeout(function () {
                toast.toast({
                    delay: 5000,
                    animation: true
                });
                toast.toast('show');
            }, 2000);

            var data1 = [
                [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 30], [11, 10], [12, 13], [13, 4], [14, 3], [15, 3], [16, 6]
            ];
            var data2 = [
                [0, 1], [1, 0], [2, 2], [3, 0], [4, 1], [5, 3], [6, 1], [7, 5], [8, 2], [9, 3], [10, 2], [11, 1], [12, 0], [13, 2], [14, 8], [15, 0], [16, 0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#d5d5d5'
                    },
                    colors: ["#1ab394", "#1C84C6"],
                    xaxis: {
                    },
                    yaxis: {
                        ticks: 4
                    },
                    tooltip: false
                }
            );

            var doughnutData = {
                labels: ["App", "Software", "Laptop"],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
                }]
            };

            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };

            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, { type: 'doughnut', data: doughnutData, options: doughnutOptions });

            var doughnutData = {
                labels: ["App", "Software", "Laptop"],
                datasets: [{
                    data: [70, 27, 85],
                    backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
                }]
            };

            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };

            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, { type: 'doughnut', data: doughnutData, options: doughnutOptions });

        });

        $(window).bind("scroll", function () {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);

        });
    </script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]
            });
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
    
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `¿Está seguro de que desea eliminar este registro?`,
                text: "Si borra esto, desaparecerá para siempre.",
                icon: "Aviso",
                buttons: true,
                dangerMode: true,
                confirmButtonText: 'Eliminar!',
                cancelButtonText: 'Cancelar',
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    
    </script>
</body>

</html>