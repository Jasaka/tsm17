<?php
	
		class nutzerDaten {
			
			public $kennung;
			public $vorname;
			public $nachname;
			public $email;
			public $geburtstag;
			public $geburtsmonat;
			public $geburtsjahr;
			public $tsgruppe;
			public $strasse;
			public $hausnummer;
			public $plz;
			public $ort;
			public $hinweise;
			public $emailBestaetigt = false;
			public $modulInteressen = false;
			/*public $fotografie;
			public $videografie;
			public $nachbearbeitung;
			public $webdesign;
			public $layout;
			public $journalismus;
			public $recht;
			public $fotografieInteresse;
			public $videografieInteresse;
			public $nachbearbeitungInteresse;
			public $webdesignInteresse;
			public $layoutInteresse;
			public $journalismusInteresse;
			public $rechtInteresse;*/
			
			public $eingabeFehler = array();
			
			
			function fehlerVorhanden(){
				for($i = 0; $i < 9; $i++){
					if($this->eingabeFehler[$i] == 1){
						return true;
					}
				}
				return false;
			}
			
			function datenEintragen(){
				$mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
				if($mysqli->connect_errno){
					die("<p>Verbindung zur Datenbank fehlgeschlagen: ".$mysqli->connect_error."</p>");
				}
				if(mysqli_num_rows($mysqli->query("SELECT kennung FROM anmeldedaten WHERE email = '".html_entity_decode($this->email)."'"))==0){
				
					$query = "INSERT INTO `tsms`.`anmeldedaten` (`kennung`, `vorname`, `nachname`, `email`, `geburtstag`, `geburtsmonat`, `geburtsjahr`, `tsgruppe`, `strasse`, `hausnummer`, `plz`, `ort`, `hinweise`, `skills`, `emailBestaetigt`) VALUES ('".$this->kennungErstellen()."', '".$this->vorname."', '".$this->nachname."', '".$this->email."', '".$this->geburtstag."', '".$this->geburtsmonat."', '".$this->geburtsjahr."', '".$this->tsgruppe."', '".$this->strasse."', '".$this->hausnummer."', '".$this->plz."', '".$this->ort."', '".$this->hinweise."', '0', '0');";
					print("Test");
					$result = $mysqli->query($query)
						or die("<p>Deine Daten konnten nicht in die Datenbank eingetragen werden.</p>");
					
					//$result = free();	
					$mysqli->close;
							
					return true;
				} else {
					//print("<p>Du hast dich bereits angemeldet und eine Best&auml;tigungsemail erhalten. Sollte diese nicht angekommen sein, wende dich bitte an kontakt@tsm17.de</p>");
					//$result = free();	
					$mysqli->close;
					return false;
				}
				
			}
			
			function datenUpdatenMitKennung($kennungInt){
				$mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
				if($mysqli->connect_errno){
					die("<p>Verbindung zur Datenbank fehlgeschlagen: ".$mysqli->connect_error."</p>");
				}
				$query = "UPDATE `tsms`.`anmeldedaten` SET `vorname`='".$this->vorname."', `nachname`='".$this->nachname."', `email`='".$this->email."', `geburtstag`='".$this->geburtstag."', `geburtsmonat`='".$this->geburtsmonat."', `geburtsjahr`='".$this->geburtsjahr."', `tsgruppe`='".$this->tsgruppe."', `strasse`='".$this->strasse."', `hausnummer`='".$this->hausnummer."', `plz`='".$this->plz."', `ort`='".$this->ort."', `hinweise`='".$this->hinweise."'  WHERE kennung = '".$kennungInt."';";
				print($query);
				if($result = $mysqli->query($query)) {
					$mysqli->close();
					return true;
				} else {
					$mysqli->close();
					return false;
				}
			}
			
			function bestaetigungsEmailSenden(){
				
				$betreff = "Deine Anmeldung zum #tsm17";
				
				$text = "Hallo ".$this->vorname.",\n\nwir freuen uns, dass du beim Medienseminar dabei sein möchtest. Bitte überprüfe deine Angaben, und klicke auf den Bestätigungslink weiter unten in dieser Email. \n\n\n Name: ".$this->vorname." ".$this->nachname."\n\nGeburtsdatum: ".$this->geburtstag.".".$this->geburtsmonat.".".$this->geburtsjahr."\n\nAdresse: ".$this->strasse." ".$this->hausnummer.", ".$this->plz." ".$this->ort."\n\n\nFehler gefunden? Dann klick hier: www.tsm17.de/php/fehlergefunden.php?kennung=".$this->kennung."\n\nAlles richtig? Dann bestätige deine Anmeldung mit einem Klick auf diesen Link: wwww.tsm17.de/php/emailBestaetigen.php?kennung=".$this->kennung."\n\n\nMerk dir bitte auch deine Kennung: ".$this->kennung."\n\n\nWir melden uns demnächst bei dir mit weiteren Infos.\n\nDein #tsm17-Team";
				
				$headers   = array();
				$headers[] = "From: noreply@tsm17.de";
				$headers[] = "Reply-To: {kontakt@tsm17.de}";
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-type: text/plain; charset=iso-8859-1";
				$headers[] = "Subject: {".$betreff."}";
				$headers[] = "X-Mailer: PHP/".phpversion();
				
				
				if(mail($this->email, $betreff, $text)){
					return true;	
				} else {
					return false;
				}
				
			}
			
			function nutzerDatenAusDatenbankMitKennung($kennung){
				$mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
				$query = "SELECT * FROM anmeldedaten WHERE kennung LIKE '".$kennung."'";
				$result = $mysqli->query($query);
				if($result->num_rows > 0) {
					$row = $result->fetch_row();
					
					$this->setVorname($row[1]); 
					$this->setNachname($row[2]);
					$this->setEmail($row[3]);
					$this->setGeburtsdatum($row[4], $row[5], $row[6]);
					$this->setTsgruppe($row[7]); 
					$this->setStrasse($row[8]);
					$this->setHausnummer($row[9]);
					$this->setPlz($row[10]); 
					$this->setOrt($row[11]); 
					$this->setHinweise($row[12]);
					
					
					$result->close;
					
					return true;
				} else {
					return false;
				}
			}
			
			function kennungErstellen(){
				$output = rand(100000, 999999);
				
				$mysqli = new mysqli("localhost", "tsms", "phae7eir4Ema7", "tsms");
				
				while(mysqli_num_rows($mysqli->query("SELECT kennung FROM anmeldedaten WHERE kennung LIKE ".$output)) != 0){
					$output = rand(100000, 999999);
				}
				$mysqli->close;
				
				$this->kennung = $output;
				return $output;
			}
			
			
			function getVorname(){
				return $this->vorname;
			} 
			
			function setVorname($vorname){
				if($vorname == '' || strlen($vorname) < 2) {
					$this->eingabeFehler[0] = 1;
				} else {
					$this->eingabeFehler[0] = 0;
					$this->vorname = html_entity_decode($vorname);
				}
			}
			
			function getNachname(){
				return $this->nachname;
			} 
			
			function setNachname($nachname){
				if($nachname == '' || strlen($nachname) < 2) {
					$this->eingabeFehler[1] = 1;
				} else {
					$this->eingabeFehler[1] = 0;
					$this->nachname = html_entity_decode($nachname);
				}
			}
			
			function getEmail(){
				return $this->email;
			} 
			
			function setEmail($email){
				if(!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
					$this->eingabeFehler[2] = 1;
				} else {
					$this->eingabeFehler[2] = 0;
					$this->email = html_entity_decode($email);
				}
			}
			
			function getGeburtstag(){
				return $this->geburtstag;
			}
			function getGeburtsmonat(){
				return $this->geburtsmonat;
			}
			function getGeburtsjahr(){
				return $this->geburtsjahr;
			}
			function setGeburtsdatum($bday, $bmonth, $byear){
				if(!checkdate($bmonth, $bday, $byear)) {
					$this->eingabeFehler[3] = 1;
				} else {
					$this->eingabeFehler[3] = 0;
					$this->geburtstag = $bday;
					$this->geburtsmonat = $bmonth;
					$this->geburtsjahr = $byear;
				}
			}
			
			function getTsgruppe(){
				return $this->tsgruppe;
			} 
			
			function setTsgruppe($tsgruppe){
				if(strlen($tsgruppe) < 3) {
					$this->eingabeFehler[4] = 1;
				} else {
					$this->eingabeFehler[4] = 0;
					$this->tsgruppe = html_entity_decode($tsgruppe);
				}
			}
			
			function getStrasse(){
				return $this->strasse;
			} 
			
			function setStrasse($strasse){
				if(strlen($strasse) < 3) {
					$this->eingabeFehler[5] = 1;
				} else {
					$this->eingabeFehler[5] = 0;
					$this->strasse = html_entity_decode($strasse);
				}
			}
			
			function getHausnummer(){
				return $this->hausnummer;
			}
			function setHausnummer($hausnummer){
				if($hausnummer == '' OR  $hausnummer < 0 OR $hausnummer > 2000) {
					$this->eingabeFehler[6] = 1;
				} else {
					$this->eingabeFehler[6] = 0;
					$this->hausnummer = $hausnummer;
				}
			}
			
			function getPlz(){
				return $this->plz;
			}
			function setPlz($plz){
				if($plz == '' OR  $plz < 1000 OR $plz > 99999) {
					$this->eingabeFehler[7] = 1;
				} else {
					$this->eingabeFehler[7] = 0;
					$this->plz = $plz;
				}
			}
			
			function getOrt(){
				return $this->ort;
			} 
			
			function setOrt($ort){
				if(strlen($ort) < 2) {
					$this->eingabeFehler[8] = 1;
				} else {
					$this->eingabeFehler[8] = 0;
					$this->ort = html_entity_decode($ort);
				}
			}
			
			function getHinweise(){
				return $this->hinweise;
			} 
			function setHinweise($hinweise){
				$this->eingabeFehler[9] = 0;
				$this->hinweise = html_entity_decode($hinweise);
			}
			function getModulInteressen(){
				return $this->modulInteressen;
			} 
			
			
			
			//---------------------------------------------------
			
			/*
			function fotografieTest(){
				if($this->fotografie == '' OR $this->fotografie < 0 OR $this->fotografie > 4) {
					$this->eingabeFehler[9] = 1;
				} else {
					$this->eingabeFehler[9] = 0;
				}
			}
			function videografieTest(){
				if($this->videografie == '' OR $this->videografie < 0 OR $this->videografie > 4) {
					$this->eingabeFehler[10] = 1;
				} else {
					$this->eingabeFehler[10] = 0;
				}
			}
			function nachbearbeitungTest(){
				if($this->nachbearbeitung == '' OR $this->nachbearbeitung < 0 OR $this->nachbearbeitung > 4) {
					$this->eingabeFehler[11] = 1;
				} else {
					$this->eingabeFehler[11] = 0;
				}
			}
			function webdesignTest(){
				if($this->webdesign == '' OR $this->webdesign < 0 OR $this->webdesign > 4) {
					$this->eingabeFehler[12] = 1;
				} else {
					$this->eingabeFehler[12] = 0;
				}
			}
			function layoutTest(){
				if($this->layout == '' OR $this->layout < 0 OR $this->layout > 4) {
					$this->eingabeFehler[13] = 1;
				} else {
					$this->eingabeFehler[13] = 0;
				}
			}
			function journalismusTest(){
				if($this->journalismus == '' OR $this->journalismus < 0 OR $this->journalismus > 4) {
					$this->eingabeFehler[14] = 1;
				} else {
					$this->eingabeFehler[14] = 0;
				}
			}
			function rechtTest(){
				if($this->recht == '' OR $this->recht < 0 OR $this->recht > 4) {
					$this->eingabeFehler[15] = 1;
				} else {
					$this->eingabeFehler[15] = 0;
				}
			}*/
		}
	
	
?>