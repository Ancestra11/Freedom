<?php

date_default_timezone_set('Europe/Paris');
date_default_timezone_get();

echo "
______ _                                                 _
| ___ \ |                                               | |
| |_/ / |__   ___ _ __   ___  _ __ ___   ___ _ __   __ _| |
|  __/| '_ \ / _ \ '_ \ / _ \| '_ ` _ \ / _ \ '_ \ / _` | |
| |   | | | |  __/ | | | (_) | | | | | |  __/ | | | (_| | |
\_|   |_| |_|\___|_| |_|\___/|_| |_| |_|\___|_| |_|\__,_|_|
";

echo "\n              Mois/Jour/An HH:MM:SS\n\n";

class Freedom {

	public $Date, $Event, $DateActuelle;

	public function __construct($Date, $Event, $Heure) {
		$this->Date = $Date;
		$this->Event = $Event;
		$this->Heure = $Heure;
		$this->DateActuelle = date('m/d/y h:i:s A', time());
	}

	public function Unix() {

		// Conversion en secondes des dates, puis comparaison :
		$UnixAjd = strtotime($this->DateActuelle);
	        $UnixDate = strtotime($this->Date);
		$Difference = $UnixAjd - $UnixDate;
		return $Difference;
	}

	public function CalculTemporel() {

		$Min = 0; $Jour = 0; $Mois = 0; $An = 0;
		$Difference = $this->Unix();
		//$Difference = self::Unix();

		while ($Difference > 60) { 

        	$Min += 1;
        	$Difference -= 60;

        	if ($Min == 60) {
                $this->Heure += 1;
                $Min -= 60;
        	}

        	if ($this->Heure == 24) {
                $Jour += 1;
                $this->Heure -= 24;
        	}

        	if ($Jour == 30) {
                $Mois +=1;
                $Jour -= 30;
        	}

        	if ($Mois == 12) {
                $An +=1;
                $Mois -= 12;
        	}
		}

		echo "\nTemps passé sans fumer ".$this->Event." :\n";
		echo $An." ans, ".$Mois." mois, ".$Jour." jours, ".$this->Heure." heures, ".$Min." minutes, ".$Difference." secondes\n";
	}

	public function getDateActuelle() {
		return $this->DateActuelle;
	}
}

// Obtention des dates :
$DateTabac = date("10/21/2021 23:59:59");
$Tabac = date('m/d/y h:i:s A', strtotime($DateTabac));

$DateFinal = date("11/16/2021 23:00:00");
$Final = date('m/d/y h:i:s A', strtotime($DateFinal));

$SansTabac = new Freedom($Tabac, "de tabac", -1);
$Phenomenal = new Freedom($Final, "tout court", 0);

echo "Date actuelle : ".$Phenomenal->getDateActuelle()."\n";
echo "Dernière fois avec du tabac : ".$Tabac."\n";
echo "Dernière fois tout court : ".$Final."\n";

$SansTabac->CalculTemporel();
$Phenomenal->CalculTemporel();

echo "\n"; ?>
