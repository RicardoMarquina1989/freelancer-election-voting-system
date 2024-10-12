<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Additt Portal</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="css/responsive-slider.css" rel="stylesheet">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/dpicker.css" rel="stylesheet">
  <script src="js/dpicker.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-color:#f0f0f7; ">


  <!-- Navigation -->
  <header style="margin-bottom: 0;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container" style="margin-bottom: 0;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
            <img src="" alt="">
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <div class="menu" style="margin-bottom: 0;">
            <ul class="nav navbar-nav">
              <li>
                <a href=""></a>
              </li>
              <li>
                <a href=""></a>
              </li>
              <li>
                <a href=""></a>
              </li>
              <li>
                <a href=""></a>
              </li>
              <li>
                <a href="/logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
  </header>

  <?php
  // admin dashboard left side here
  include('includes/admin_dashboard_leftside.php');
  ?>
  <div class="col-md-9">
    <div class="spacebar"></div>
    <div class=" panel panel-info">
      <div class="panel-heading">
        <div class="panel-tilte">
          Create New Vacancy
        </div>
      </div>
      <div class="panel-body">
        <form action="action_page.php">
          <div class="container">
            <div class="row">
              Date formats: yyyy-mm-dd, yyyymmdd, dd-mm-yyyy, dd/mm/yyyy, ddmmyyyyy
            </div>
            <br />
            <div class="row">
              <div class='col-sm-3'>
                <div class="form-group">
                  <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            $(function() {
              var bindDatePicker = function() {
                $(".date").datetimepicker({
                  format: 'YYYY-MM-DD',
                  icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                  }
                }).find('input:first').on("blur", function() {
                  // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                  // update the format if it's yyyy-mm-dd
                  var date = parseDate($(this).val());

                  if (!isValidDate(date)) {
                    //create date based on momentjs (we have that)
                    date = moment().format('YYYY-MM-DD');
                  }

                  $(this).val(date);
                });
              }

              var isValidDate = function(value, format) {
                format = format || false;
                // lets parse the date to the best of our knowledge
                if (format) {
                  value = parseDate(value);
                }

                var timestamp = Date.parse(value);

                return isNaN(timestamp) == false;
              }

              var parseDate = function(value) {
                var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
                if (m)
                  value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

                return value;
              }

              bindDatePicker();
            });
          </script>


      </div>

      <input type="submit" name="saveVacancy" value="Save" class="btn btn-info" style="float: left;">
      <input type="submit" name="publishVacancy" value="Publish" class="btn btn-success" style="float: right;">
      </form>
    </div>
  </div>


  </div>


  </div>



  <div class="home-image">
    <div class="">

    </div>
  </div>
  <div class="spacebar"></div>



  <!-- services -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="footer-social-media">
          <h4></h4>

        </div>
      </div>
    </div>
  </div>
  <div class="spacebar"></div>
  <?php include_once("includes/footer.php"); ?>