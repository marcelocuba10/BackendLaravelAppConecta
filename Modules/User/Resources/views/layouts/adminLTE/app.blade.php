<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon" />
  <title>Conectacode | {{ config('app.name')}}</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/lineicons.css" />
  <link rel="stylesheet" href="/assets/css/LineIcons.css" />
  <link rel="stylesheet" href="/assets/css/quill/bubble.css" />
  <link rel="stylesheet" href="/assets/css/quill/snow.css" />
  <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="/assets/css/main.css" />
  <link rel="stylesheet" href="/assets/css/morris.css" />
  <link rel="stylesheet" href="/assets/css/datatable.css" />
  <link rel="stylesheet" href="/assets/css/vanilla-dataTables.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
  <link rel="stylesheet" href="/css/custom-style.css">

  <!-- ========= All Javascript files linkup ======== -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

  <!-- ========= All jQuery files linkup ======== -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ========= All HTML content ======== -->
  @include('user::layouts.adminLTE.sidebar')
  @include('user::layouts.includes.alerts')

  <main class="main-wrapper">
    @include('user::layouts.adminLTE.navbar')
    @yield('content')
    @include('user::layouts.adminLTE.footer')
  </main>

  <!-- ========= All Javascript files linkup ======== -->
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/Chart.min.js"></script>
  <script src="/assets/js/dynamic-pie-chart.js"></script>
  <script src="/assets/js/moment.min.js"></script>
  <script src="/assets/js/fullcalendar.js"></script>
  <script src="/assets/js/jvectormap.min.js"></script>
  <script src="/assets/js/world-merc.js"></script>
  <script src="/assets/js/polyfill.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/js/custom.js"></script>
  <script src="/js/vanilla-masker.min.js"></script>
  <script src="/assets/js/apexcharts.min.js"></script>
  <script src="/assets/js/quill.min.js"></script>
  <script src="/assets/js/datatable.js"></script>
  <script src="/assets/js/Sortable.min.js"></script>

  <!-- ========= Maskmoney files linkup ======== -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>

  <!-- ========= Scripts ======== -->
  <script>

    /** ========= Alert hide ======== **/
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").alert('close');
        }, 2500);
    
        setTimeout(function() {
            $(".alert-danger").alert('close');
        }, 2500);
    });

    /** ========= InputMask ======== **/
    document.addEventListener("DOMContentLoaded", readyInputMask);
    function readyInputMask() {
      VMasker(document.getElementById("phone")).maskPattern('(999) 999 999');
      VMasker(document.getElementById("date")).maskPattern('99/99/9999');
    }

    /** ========= Tooltip ======== **/
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });

    /** ========= Calendar ======== **/
    document.addEventListener("DOMContentLoaded", function () {
      var calendarMiniEl = document.getElementById("calendar-mini");
      var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
        initialView: "dayGridMonth",
        headerToolbar: {
          end: "today prev,next",
        },
      });
      calendarMini.render();
    });

  </script>
  
</body>

</html>