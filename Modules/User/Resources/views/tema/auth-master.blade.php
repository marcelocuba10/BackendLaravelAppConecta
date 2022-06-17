<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name')}} | Forgot password</title>

    <link href="/tema/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tema/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/tema/css/animate.css" rel="stylesheet">
    <link href="/tema/css/style.css" rel="stylesheet">
    <link href="/tema/css/plugins/iCheck/custom.css" rel="stylesheet">

    <style>
        .recovery-ibox {
            border-radius: 8px;
            box-sizing: border-box;
            background-color: rgb(255, 255, 255);
            box-shadow: rgb(0 0 0 / 21%) 0px 2px 8px 0px;
            width: 480px;
            padding: 24px 30px;
        }

        .recovery-bg {
            background-repeat: no-repeat;
            background-image: url(/img/bg-pattern.png);
            background-size: contain;
            position: relative;
            flex-direction: row;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            width: 100%;
            height: auto;
            background-color: #121D33;
        }

        .huRTra {
            width: 230px;
            display: block;
            margin: 5px auto 20px auto;
        }

        .grfsd{
            margin-bottom: 20px;
        }
        .dfdfdf{
            color: #676a6c;
            font-weight: 550;
            font-size: 14px;
        }
        .icddd{
            background-color: rgb(236, 245, 254);
            padding: 15px;
            border-radius: 30px;
            color: rgb(12, 108, 242);
            margin-right: 10px;
        }
        .llpl{
            margin-left: 57px;
            margin-top: -10px;
            font-weight: 500;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 2px;
        }

    </style>
</head>

<body class="recovery-bg">

    @yield('content')

    <!-- Mainly scripts -->
    <script src="/tema/js/jquery-3.1.1.min.js"></script>
    <script src="/tema/js/popper.min.js"></script>
    <script src="/tema/js/bootstrap.js"></script>
    <!-- iCheck -->
    <script src="/tema/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>