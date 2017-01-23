<!DOCTYPE html>
<html lang='de'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='#tsm17 - Dein TEN SING Medienseminar: Anmeldung'>
    <meta name='author' content='Jan Samak'>

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
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
    <![endif]-->

</head>

<body id='page-top' class='index'>

	<?php
		
		$kennung = $_GET['kennung'];
        require_once('nutzerDaten.php');
		$nutzerDaten = new nutzerDaten();
		
		if($nutzerDaten->nutzerDatenAusDatenbankMitKennung($kennung) != true) {
			$output = "<div class='container'>
        <div class='row text-center'>
            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
                <h3>Leider wissen wir nicht, wer du bist!</h3>
                <p>Hilf uns mit deiner #tsm17-Kennung aus der Bestätigungs-E-Mail</p>
                <form method='get' action='skillsFormular.php?'>
                	
	                <div class='row'>
	                    <div class='form-group col-sm-12'>
	                        <input type='text' class='form-control' name='kennung' id='kennung' placeholder='Kennung'>
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

		} else {
			
			$mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
			
			if(mysqli_num_rows($mysqli->query("SELECT kennung FROM skills WHERE kennung = '".$kennung."'")) != 0){
				$mysqli->query("UPDATE `tsms`.`anmeldedaten` SET `skills`='1'");
				header("Location: anmeldungErfolgreich.php?kennung=".$kennung);
			} else {
				$result = $mysqli->query("SELECT modul FROM skillsList ORDER BY modulKey ASC");
				
				$query = "INSERT INTO skills (`kennung`, ";
				$i = 0;
				while($row = $result->fetch_row()){
					$query .= "`".$row[0]."`, `".$row[0]."I`";
					if($i < 41){
						$query .= ", ";
					}
					$i++;
				}
				$query .= ") VALUES ('".$kennung."', ";
				
				//$result->free();
				$result = $mysqli->query("SELECT modul FROM skillsList ORDER BY modulKey ASC");
				
				$i = 0;
				while($row = $result->fetch_row()){
					$query .= "'".$_POST[$row[0]]."', '".$_POST[$row[0]."I"]."'";
					if($i < 41){
						$query .= ", ";
					}
					$i++;
				}
				$query .= ")";
				
				//print($query); //query zu Testzwecken ausgeben
				if($mysqli->query($query) === TRUE){
					$mysqli->query("UPDATE `tsms`.`anmeldedaten` SET `skills`='1'");
					header("Location: anmeldungErfolgreich.php?".$kennung);
				} else {
					print("<section>
	<div class='container'>
        <div class='row text-center'>
            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
                <h3>Leider hat das Eintragen deiner Interessen nicht funktioniert.</h3>
                <p>Es tut uns leid, dass die viele Arbeit umsonst war</p>
                <h4>Bitte kontaktiere uns via kontakt@tsm17.de!</h4>
            </div>
        </div>
    </div>
</section>");
				}

			}
			
		}
			            
		
	?>
	
	    
    <!-- Footer -->
    <footer class='text-center'>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-12 col-lg-12 text-center'>
                    <a href='../index.html'><div class='btn btn-block btn-default pink-button back-button'>Zurück</div></a>
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



