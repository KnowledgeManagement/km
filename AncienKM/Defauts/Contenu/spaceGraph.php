<?php

// Cette fonction transforme une string en un tableau
function str2arr($string)
{
	// Initialisation de l'index
	$index = 0;

	// On parcourt la chaîne
	// Attention : infini ...
	while($string)
	{
		// On transpose le caractère actuel de la chaîne 
		// dans un "vrai" tableau.
		$array[$index] = $string[$index];
		
		// Incrémentation de l'index
		$index++;

		// Pour éviter de boucler indéfiniment :
		// Si caractère final (NULL) on arrète tout !
		if($string[$index]==NULL) break;
	}

	// On retourne le tableau de résultat
	return $array;
}

function spaceGraph($repertoire,$options,$x,$y,$contour,$barre,$fond)
{
//if(!$repertoire && $options &&$x && $y && $contour && $barre && $fond) return "Erreur : un argument est manquant.";
		
	// ----------------- ************* Décodage des couleurs
	
// Décodage de $contour	
$couleur1 = hexdec($contour[1].$contour[2]);
$couleur2 = hexdec($contour[3].$contour[4]);
$couleur3 = hexdec($contour[5].$contour[6]);
$contour = array($couleur1,$couleur2,$couleur3);

// Décodage de $barre
$couleur1 = hexdec($barre[1].$barre[2]);
$couleur2 = hexdec($barre[3].$barre[4]);
$couleur3 = hexdec($barre[5].$barre[6]);
$barre = array($couleur1,$couleur2,$couleur3);

// Décodage de $fond
$couleur1 = hexdec($fond[1].$fond[2]);
$couleur2 = hexdec($fond[3].$fond[4]);
$couleur3 = hexdec($fond[5].$fond[6]);
$fond = array($couleur1,$couleur2,$couleur3);

	// ----------------- ************* Fin
	
	// ----------------- ************* Décodage des options

// Décomposition des options
$tab_options = str2arr($options);
$cur_option = "";

// Détection de la langue
$index = array_search("e", $tab_options, TRUE);
if(!$index) $index = array_search("f", $tab_options, TRUE);

	// ----------------- ************* Fin

	// ----------------- ************* Génération de l'image
	
// Création de l'image dans la mémoire
$image = imagecreate($x,$y+10);

// Allocation des couleurs
$fondC = imagecolorallocate($image,$fond[0],$fond[1],$fond[2]);
$contourC = imagecolorallocate($image,$contour[0],$contour[1],$contour[2]);
$barreC = imagecolorallocate($image,$barre[0],$barre[1],$barre[2]);

// Fond de l'image
imagefill($image,0,0,$fondC);

// Tracé du contour
imagerectangle($image,0,0,$x-1,$y-1,$contourC);

	// ----------------- ************* Fin
	
	// ----------------- ************* Calculs

// Espace total du répertoire
$spc_total = disk_total_space($repertoire);
$spc_total = floor($spc_total);

// Espace libre du répertoire
$spc_libre = disk_free_space($repertoire);
$spc_libre = floor($spc_libre);

// Calcul de l'espace occupé = total - libre
$spc_used = $spc_total - $spc_libre;

// On ote trois pixels de la taille maximum
$taillePossible = $x-3;

	// ----------------- ************* Fin
	
	// ----------------- ************* "Localize me baby" + calculs
	
// Cette variable va stocker le message à écrire
$texte_aff = "";

// Français sélectionné
if($tab_options[$index] == "f") 
{
	foreach($tab_options as $cur_option)
	{
		if($cur_option != "f")
		{
			switch($cur_option)
			{
				case "r":
					$pourcent = floor((100*$spc_libre)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$texte_aff = $pourcent."% restants";
				break;
				
				case "R":
					$pourcent = floor((100*$spc_libre)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
				
					$mo_dispo = floor($spc_libre / 1000000);			
					
					$texte_aff = $mo_dispo." Mo restants";
				break;
				
				case "o":
					$pourcent = floor((100*$spc_used)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$texte_aff = $pourcent."% occupés";
				break;
				
				case "O":
					$pourcent = floor((100*$spc_used)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$mo_used = floor($spc_used / 1000000);
					
					$texte_aff = $mo_used." Mo occupés";
				break;				
				
				default:
					return "Erreur : une fausse option a été invoquée ($cur_option)";
				break;
			}
		}
	}
}

// English selected
elseif($tab_options[$index] == "e")
{
	foreach($tab_options as $cur_option)
	{
		if($cur_option != "e")
		{
			switch($cur_option)
			{
				case "r":
					$pourcent = floor((100*$spc_libre)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$texte_aff = $pourcent."% remaining";
				break;
				
				case "R":
					$pourcent = floor((100*$spc_libre)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
				
					$mo_dispo = floor($spc_libre / 1000000);			
					
					$texte_aff = $mo_dispo." Mo remaining";
				break;
				
				case "o":
					$pourcent = floor((100*$spc_used)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$texte_aff = $pourcent."% occupied";
				break;
				
				case "O":
					$pourcent = floor((100*$spc_used)/$spc_total);
					$x = floor(($taillePossible*$pourcent)/100);
					
					$mo_used = floor($spc_used / 1000000);
					
					$texte_aff = $mo_used." Mo occupied";
				break;				
				
				default:
					return "Erreur : une fausse option a été invoquée ($cur_option)";
				break;
			}
		}
	}
}	
else
{
	return "Erreur : pas de langue sélectionnée";	
}

	// ----------------- ************* Fin
	
	// ----------------- ************* Finalisation de l'image

// Tracé du contour
imagerectangle($image,2,2,$x,$y-3,$contourC);

// Tracé du remplissage
imagefilledrectangle($image,3,3,$x-1,$y-4,$barreC);

// Texte à écrire en bas
imagestring($image, 1, 5, $y+1, $texte_aff, $contourC);

// Police antialiasée : pas de test effectué ! Version de PHP trop ancienne, pas de support "T1lib"
// imagepstext($image, $texte_out, 1, 8, $contourC, $fondC, 5, $y+9, 16);

// Enregistrement dans le répertoire temporaire
if(imagePNG($image,"Images/spaceGraph.png")) return "Images/spaceGraph.png";

// Destruction de la mémoire
imagedestroy($image);

	// ----------------- ************* Fin
}
?>