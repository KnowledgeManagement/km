<?php
	// $nombre = 4581;//recup�re le nombre entr� en param�tre
	// $tableauBoolean = array();//initalise un tableau de booleans
	// for($i = 2; $i <= $nombre; $i++)// on parcourt tous les nombres de 2 � $nombre
	// {
		// $tableauBoolean[$i] = 1;//Pour chaque �l�ment du tableau, on initialise la valeur � 1 (consid�r�s comme tous premiers)
	// }
	// $count = 0;// on initialise count � 0
	// for($j = 2; $j <= $nombre; $j++)// on reparcourt tous les nombres de 2 � $nombre
	// {
		// for($k = ($j+1); $k <= $nombre; $k++)// pour chaque nombre, on compare tous les nombres qui suivent celui ci (ex : j = 30; k commence � 31)
		// {
			// if($tableauBoolean[$k] == 1)//Si la valeur du tableau �tait � 1 (et donc consid�r� comme premier)
			// {
				// if(!preg_match("#[^0-9]#", $k/$j))//Si la division de $k par $j ne poss�de pas de reste, il ne s'agit pas d'un nombre premier
					// $tableauBoolean[$k] = 0;// on change la valeur de tableauBoolean[$k] par 0 ( = non premier)
			// }
		// }
	// }
	
	// for($i = 2; $i <= $nombre; $i++)
	// {
		// if($tableauBoolean[$i] == 1)
		// {
			// echo $i.'<br/>';
			// $count++;
		// }
	// }
	// echo "Il y a : ".$count." nombre premier avant ".$nombre;
	
	include_once "../../../SQL/Fonctions_SQL/user.php";
	updateFromAD();
?>