<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#tsm17 - Dein TEN SING Medienseminar: Anmeldung">
    <meta name="author" content="Jan Samak">

    <title>tsm17 - Dein TEN SING Medienseminar: Anmeldung</title>

    <link rel='shortcut icon' href='../img/favicon.ico'>
    <!-- Bootstrap Core CSS -->
    <link href='../vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Theme CSS -->
    <link href='../css/tsm17.css' rel='stylesheet'>
    <link href='../css/side.css' rel='stylesheet'>

    <!-- Custom Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans' />
    <link href='vendor/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Header -->
    <section>
        <div class="container">
            <div class="intro-text">
	            
	            <?php
		            
		            $kennung = $_GET['kennung'];
		            
		            $mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
		            
		            if(mysqli_num_rows($mysqli->query("SELECT kennung FROM anmeldedaten WHERE kennung = '".$kennung."'")) == 1){
			            $mysqli->query("UPDATE  `tsms`.`anmeldedaten` SET  `emailBestaetigt` =  '1' WHERE  `anmeldedaten`.`kennung` =  '".$kennung."'");
			            print("<div class='container'>
        <div class='row text-center'>
            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box yay'>
                <h3>Vielen Dank, dass du deine persönlichen Daten bestätigt hast!</h3>
                <p>Jetzt musst du uns nur noch was über dich verraten.</p>
                <h4><a href='skillsFormular.php?kennung=".$kennung."'>Hier kannst du das tun</a></h4>
            </div>
        </div>
    </div>");
		            } else {
			            print("<div class='container'>
        <div class='row text-center'>
            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
                <h3>Die Nutzer-Kennung ".$kennung." ist uns leider nicht bekannt</h3>
                <p>Es tut uns leid, dass dieser Fehler aufgetreten ist.</p>
                <h4>Bitte wende dich an kontakt@tsm17.de</h4>
            </div>
        </div>
    </div>");
		            }
		            
		            
		            
	            ?>
	            
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 text-center">
                    <a href="../index.html"><div class="btn btn-block btn-default pink-button back-button">Zurück</div></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src='../vendor/jquery/jquery.min.js'></script>

    <!-- Bootstrap Core JavaScript -->
    <script src='../vendor/bootstrap/js/bootstrap.min.js'></script>

    <!-- Plugin JavaScript -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

    <!-- Theme JavaScript -->
    <script src='../js/tsm17.js'></script>

</body>

</html>

