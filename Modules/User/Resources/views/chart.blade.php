@extends('user::layouts.adminLTE.app')
@section('content')

<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Highcharts Example</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/user/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/user/customers">Clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalle Cliente</li>
                        </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->
        <div class="invoice-wrapper">
            <div class="row">
                <div class="col-12 off-mobile">
                    <div class="invoice-card card-style mb-30">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var users =  <?php echo json_encode($users) ?>;
   
    Highcharts.chart('container', {
        title: {
            text: 'New User Growth, 2019'
        },
        subtitle: {
            text: 'Source: itsolutionstuff.com.com'
        },
         xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of New Users'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Users',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>

@endsection 