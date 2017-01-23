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


    	<?php
	    require_once("nutzerDaten.php");
		
		$nutzerDaten = new nutzerDaten();
		
		$nutzerDaten->setVorname($_POST['vorname']);
		$nutzerDaten->setNachname($_POST['nachname']);
		$nutzerDaten->setEmail($_POST['email']);
		$nutzerDaten->setGeburtsdatum($_POST['geburtstag'], $_POST['geburtsmonat'], $_POST['geburtsjahr']);
		$nutzerDaten->setTsgruppe($_POST['tsgruppe']);
		$nutzerDaten->setStrasse($_POST['strasse']);
		$nutzerDaten->setHausnummer($_POST['hausnummer']);
		$nutzerDaten->setPlz($_POST['plz']);
		$nutzerDaten->setOrt($_POST['ort']);
		$nutzerDaten->setHinweise($_POST['hinweise']);
		
		
		if(!$nutzerDaten->fehlerVorhanden()){
			if($nutzerDaten->datenEintragen()){
				if($nutzerDaten->bestaetigungsEmailSenden()){
					header('Location: ../bestaetigungGesendet.html'); 
				} else {
					print("<section>
		<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Die Bestätigungs-E-Mail konnte nicht versendet werden.</h3>
	                <p>Es tut uns leid, dass dieser Fehler aufgetreten ist.</p>
	                <h4>Bitte wende dich an <a href='mailto:kontakt@tsm17.de'>kontakt@tsm17.de</a></h4>
	            </div>
	        </div>
	    </div>
	</section>");
				}
			} else {
				print("<section>
		<div class='container'>
	        <div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Beim Eintragen deiner Daten in die Datenbank ist ein Fehler aufgetreten.</h3>
	                <p>Es tut uns leid, dass dieser Fehler aufgetreten ist.</p>
	                <h4>Bitte wende dich an <a href='mailto:kontakt@tsm17.de'>kontakt@tsm17.de</a></h4>
	            </div>
	        </div>
	    </div>
	</section>");
			}
		} else {

			$output = "
	    <!-- Main Section -->
    <section>
        <div class='container'>
	        
			<div class='row text-center'>
	            <div class='col-lg-offset-1 col-lg-10 col-xs-10 col-xs-offset-1 box nay'>
	                <h3>Leider ist etwas schief gelaufen!</h3>
	                <p>Bitte korrigiere die markierten Felder</p>
	                <h4>Dann klappt es bestimmt.</h4>
	            </div>
	        </div>
        </div>
    </section>    
    <section id='anmeldeformular'>
        <div class='container'>
            <form action='anmeldungEintragen.php' method='post' id='anmeldung'>
                <div class='col-lg-12 text-center'>
                    <h2 class='section-heading'>Schritt 1</h2>
                </div>
                <div class='row'>
                    <div class='form-group ";
			if($nutzerDaten->eingabeFehler[0] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-6'>
                        <input type='text' class='form-control' name='vorname' id='vorname' placeholder='Vorname' value='".$nutzerDaten->vorname."'>
                    </div>
                    <div class='form-group ";
			if($nutzerDaten->eingabeFehler[1] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-6'>
                        <input type='text' class='form-control' name='nachname' id='nachname' placeholder='Nachname' value='".$nutzerDaten->nachname."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[2] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-6'>
                        <input type='email' class='form-control' name='email' id='email' placeholder='E-Mail-Adresse' value='".$nutzerDaten->email."'>
                    </div>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[4] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-6'>
                        <input type='text' class='form-control' name='tsgruppe' id='tsgruppe' placeholder='TEN SING Gruppe' value='".$nutzerDaten->tsgruppe."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[3] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-3'>
                        <input type='text' class='form-control' name='geburtstag' id='geburtstag' placeholder='Geburtstag'  value='".$nutzerDaten->geburtstag."'>
                    </div>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[3] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-3'>
                        <input type='text' class='form-control' name='geburtsmonat' id='geburtsmonat' placeholder='Geburtsmonat' value='".$nutzerDaten->geburtsmonat."'>
                    </div>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[3] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-6'>
                        <input type='text' class='form-control' name='geburtsjahr' id='geburtsjahr' placeholder='Geburtsjahr' value='".$nutzerDaten->geburtsjahr."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[5] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-9'>
                        <input type='text' class='form-control' name='strasse' id='strasse' placeholder='Stra&szlig;e' value='".$nutzerDaten->strasse."'>
                    </div>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[6] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-3'>
                        <input type='text' class='form-control' name='hausnummer' id='hausnummer' placeholder='Hausnummer' value='".$nutzerDaten->hausnummer."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[7] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-4'>
                        <input type='text' class='form-control' name='plz' id='plz' placeholder='PLZ'  value='".$nutzerDaten->plz."'>
                    </div>
                    <div class='form-group";
			if($nutzerDaten->eingabeFehler[8] == 1){
				$output .= " has-error";
			}		    
			$output .= " col-sm-8'>
                        <input type='text' class='form-control' name='ort' id='ort' placeholder='Ort' value='".$nutzerDaten->ort."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group col-sm-12'>
                        <textarea rows='4' class='form-control' name='hinweise' form='anmeldung' placeholder='Besondere Essgewohnheiten (vegetarisch, vegan), Krankheiten, regelm&auml;&szlig;ige Medikamente, Allergien etc.' maxlength='500'>".$nutzerDaten->getHinweise()."</textarea>
                    </div>
                </div>
                <div class='row'>
                    <div class='form-group col-sm-12'>
                        <button type='submit' class='btn btn-block pink-button'>Nochmal probieren!</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
 	
			";
			//FORMULAR NOCHMAL AUSGEBEN MIT DATEN UND FELDERN ROT
			
			print($output);
			
			
		}
		
		
	?>
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

