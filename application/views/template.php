<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PRESENSI - BAP | Podomoro University</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://podomorouniversity.ac.id/main/resources/assets/img/icon/favicon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('images/logo/favicon-putih.png'); ?>"> -->



    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/animate/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatable/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/date-range/daterangepicker.css'); ?>" rel="stylesheet">
    <!-- <link href="<?php echo base_url('assets/countdown/jQuery.countdownTimer.css'); ?>" rel="stylesheet"> -->


    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Yanone+Kaffeesatz" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/moment_id.js'); ?>"></script>

    <script src="<?php echo base_url('assets/date-range/daterangepicker.js'); ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatable/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatable/dataTables.bootstrap.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/barcode/jquery-barcode.js'); ?>"></script>
    <script src="<?php echo base_url('assets/print-this/printThis.js'); ?>"></script>


    <script src="<?php echo base_url('assets/countdown/jQuery.countdownTimer.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/global_function.js'); ?>"></script>

    <!-- TO GLOBAL VARIABLE JS -->
    <script>
        window.js_base_url = "<?php echo base_url(); ?>"
    </script>





    <style media="screen">
        body {
            background: url(<?php echo base_url('assets/bg.jpg'); ?>) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .navbar-default {
            height: 55px;
        }
        .navbar-brand {
            padding: 10px 15px;
        }
        #time {
            font-size: 25px;
            font-family: 'Barlow Condensed', sans-serif;
        }
        #copyright {
            font-size: 17px;
            font-family: 'Barlow Condensed', sans-serif;
        }
        .fa-left {
            margin-right: 5px;
        }
        .fa-right {
            margin-left: 5px;
        }

        .label-info-custom {
            background: #fff;
            color: #333;
            border: 2px solid #5bc0de;
            font-weight: 100;
            border-radius: 0px;
            letter-spacing: 2px;
        }
        .label-warning-custom {

            background: #fff;
            color: #333;
            border: 2px solid #f0ad4e;
            font-weight: 100;
            border-radius: 0px;
            letter-spacing: 2px;

        }
    </style>

    <script type="text/javascript">
        $.fn.extend({
            animateCss: function (animationName, callback) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function() {
                    $(this).removeClass('animated ' + animationName);
                    if (callback) {
                        callback();
                    }
                });
                return this;
            }
        });

    </script>

</head>
<body>
<div class="container" style="margin-top:30px;">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/logo.png'); ?>" alt="" style="max-height:35px"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:void(0);"><span class="" id="time"></span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
<?php  echo $content; ?>

<script type="text/javascript">

    $(document).ready(function () {



        setInterval(function () {
            $('#time').html(moment().format('dddd, Do MMM YYYY h:mm:ss A'));
        }, 1000);


    });

    function genrate_barcode(element,id_unik) {
        // console.log(element);
        // console.log(id_unik);
        $("#"+element).barcode(id_unik, "code128",{barWidth:1, barHeight:30,showHRI:true,output:"svg"});

    }
</script>
</body>
</html>
