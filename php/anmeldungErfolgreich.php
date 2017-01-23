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
		            
		            $result = $mysqli->query("SELECT skills, emailBestaetigt FROM anmeldedaten WHERE kennung = '".$kennung."'");
		            
		            if($result->num_rows == 1) {
			            $row = $result->fetch_row();
		            
			            if($row[0] == 1 && $row[1] == 1){
				            print("<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box yay'>
	                <h3>Du hast dich erfolgreich für das #tsm17 angemeldet.</h3>
	                <p>Wir freuen uns auf dich!</p>
	                <h4>Weitere Infos schicken wir dir per Email zu.</h4>
	            </div>
	        </div>
	    </div>"); 
			            } elseif($row[0] == 0 && $row[1] == 1) {
				             print("<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Bitte teile uns deine Interessen mit.</h3>
	                <p>Wir möchten die Workshops auf dein Profil anpassen</p>
	                <h4><a href='skillsFormular.php?kennung=".$kennung."'>Hier geht's zum Formular</a></h4>
	            </div>
	        </div>
	    </div>"); 
	
			            } elseif($row[0] == 1 && $row[1] == 0) {
				             print("<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Bitte bestätige deine Daten.</h3>
	                <p>Du hast eine E-Mail mit einem Bestätigungslink empfangen.</p>
	                <h4>Anschließend ist deine Anmeldung abgeschlossen.</h4>
	            </div>
	        </div>
	    </div>"); 
	
			            } else {
				             print("<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Für weitere Schritte ließ bitte die Bestätigungsemail.</h3>
	                <p>Darin findest du alles, was du brauchst</p>
	                <h4>Solltest du diese nicht erhalten haben, wende dich bitte an kontakt@tsm17.de</h4>
	            </div>
	        </div>
	    </div>"); 
	
			            }
		            } else {
			            $output = "<div class='container'>
			        <div class='row text-center'>
			            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
			                <h3>Leider wissen wir nicht, wer du bist!</h3>
			                <p>Hilf uns mit deiner #tsm17-Kennung aus der Bestätigungs-E-Mail</p>
			                <form method='get' action='anmeldungErfolgreich.php?'>
			                	
				                <div class='row'>
				                    <div class='form-group col-sm-12'>
				                        <input type='text' class='form-control' name='kennung' id='ort' placeholder='Kennung'>
				                    </div>
				                </div>
			                    <div class='form-group col-sm-12'>
			                        <button type='submit' class='btn btn-block pink-button'>Weiter</button>
			                    </div>
			                </form>
			            </div>
			        </div>
			    </div>";
				        print($output);
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

