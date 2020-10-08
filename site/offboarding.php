<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include_once 'dbcon.php';



?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fontys Offboarding Tool - Offboarding Tool</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="static/css/normalize.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/font-awesome.min.css">
    <link rel="stylesheet" href="static/css/themify-icons.css">
    <link rel="stylesheet" href="static/css/flag-icon.min.css">
    <link rel="stylesheet" href="static/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="static/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="static/scss/style.css">
    <link rel="stylesheet" href="static/css/lib/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Informatie</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children active dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Offboarding</a>

                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="offboarding.php">Offboarding Tool</a></li>
                         </ul>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
         <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">



                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">


                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-nl"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-us"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-nl"></i>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Forms</a></li>
                            <li class="active">Offboarding Tool</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php
/*
    function get_id($id){
    	if ($namen != ""){
    		retun array("id"=>$namen);
    	}
    }
    function get_names($namen){
    	if ($namen != ""){
    		retun array("id"=>$namen);
    	}
    }
    function get_names($namen){
    	if ($namen != ""){
    		retun array("id"=>$namen);
    	}
    }

        $sql = "SELECT id, firstname, lastname FROM employees;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $gebruikers = "";
    

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {}
        	$id = get_names($row["id"]);
        	$voornaam = get_names($row["firstname"]);
            $achternaam = get_names($row["lastname"]);

           $gebruikers .= $id["id"]. ' ' .$voornaam. ' ' .$achternaam;
        }*/





$sql = "SELECT id, firstname, lastname FROM employees;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

    if ($result->num_rows > 0) {
    	$employees = array();
        for($i = 0; $row = $result->fetch_assoc(); $i++) {
        	$employees[$i] = array("id"=>$row["id"],"firstname"=>$row["firstname"],"lastname"=>$row["lastname"]);

	    }



    }


// function updateDB()
// {
//     $id = $_GET['employee'];
//     $sql2 = "UPDATE hardware SET userid = '' WHERE userid = '$id'";
//         $updatehw = mysqli_query((mysqli_connect($servername, $username, $password, $dbname)), $sql2);
//         if (isset($conn)) {
//             echo "kanker";
//         }
// }
// if (array_key_exists('employee', $_GET)){
//     updateDB();

// }





    ?>

        <div class="content mt-3">
            <?php
            if (array_key_exists('employee', $_GET)){
    $id = $_GET['employee'];
    $sql2 = "UPDATE hardware SET userid = NULL WHERE userid = '$id'";
    $updatehw = mysqli_query($conn, $sql2);
    echo '<div class="alert alert-success" role="alert">

      Offboarding process successfull!

      </div>';

}?>
            <div class="animated fadeIn">

                <div class="row">

<form action="offboarding_questions.php">

                    <div class="col-xs-6 col-sm-auto">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Selecteer een gebruiker</strong>
                            </div>
                            <div class="card-body">

                                  <select name="employee" data-placeholder="Selecteer een gebruiker.." class="standardSelect" tabindex="1">
                                    <!-- <option value=""></option> -->
                                    <?php foreach ($employees as $employee) {
                                    	echo '<option value="'.$employee["id"].'">  '.$employee["id"]. ' '.$employee["firstname"].' '.$employee["lastname"]. '</option>';
                                    }?>

                                </select>
                            </div>
                        </div>



                        

<!--                         <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Is de bruikleenovereenkomst ondertekend?</strong>

                            </div>
                            <div class="card-body">

                                  
                                  <select data-placeholder="Kies een antwoord" class="standardSelect" tabindex="1">
                                    <option value=""></option>
                                    <option value="JA">Ja</option>
                                    <option value="Nee">Nee</option>
                                  </select>

                            </div>
                        </div> -->

                    </div>

                        <div class="card">


         				 </div>
         				 <input type="submit" value="Submit">
                    </div>
						</form>
                </div>


            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="static/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="static/js/popper.min.js"></script>
    <script src="static/js/plugins.js"></script>
    <script src="static/js/main.js"></script>
    <script src="static/js/lib/chosen/chosen.jquery.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    </script>

</body>
</html>
