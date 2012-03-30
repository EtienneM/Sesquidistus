<?php

 /* 
  * Module Calendrier
  * Sert à générer un document au format .pdf en reprenant les données et évènements du calendrier du mois sélectionné par l'utilisateur.
  *
  * Auteur : Benoît SOUFFLET <benoit.soufflet@gmail.com>
  */

include("../../config/mysql.php");
require('../../fpdf/fpdf.php');
include_once('../../fpdf/ufpdf.php');

mysql_connect($host, $user, $passwd); 
mysql_select_db($bdd);
mysql_query("SET NAMES 'utf8'");

$annee = $_POST['annee_pdf'];
$mois = $_POST['mois_pdf'];	
$mois2 = $mois;
if($mois2<10){$mois2 = "0".$mois;}
$titre= "RÃ©capitulatif des Ã©vÃ¨nements du mois (" .$mois2. "/".$annee.")";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

$tabTitre = array();
$tabLieu = array();
$tabType = array();
$tabDate = array();
$tabDebut = array();
$tabFin = array();
$tabColor = array();

$tabType_nomEvent = array();
$tabType_numero = array();
$tabType_color = array();

$tabLieu_nom = array();
$tabLieu_numero = array();
			
function hex2rgb($hex){ //Conversion du code couleur
  
  if(! ereg("[0-9a-fA-F]{6}", $hex)) { 
  echo "Error : input is not a valid hexadecimal number"; 
  return 0; 
  } 
  
  for($i=0; $i<3; $i++) { 
  $temp = substr($hex, 2*$i, 2); 
  $rgb[$i] = 16 * hexdec(substr($temp, 0, 1)) + 
  hexdec(substr($temp, 1, 1)); 
  } 
  
  return $rgb; 
} 

	//Requetes pour récupération des informations par rapport aux évènement du mois sélectionné
	$req4 = "SELECT TC.numero, TC.nom, TC.color FROM type_event TC, evenement E WHERE TC.numero = E.type AND E.date BETWEEN '$date2' AND '$date1'";
	$res4 = mysql_query($req4)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					
	
	$reqlieu = "SELECT lu.nom, lu.numero FROM lieu_ultimate lu, evenement E WHERE lu.numero = E.id_lieu AND E.date BETWEEN '$date2' AND '$date1' ORDER BY E.date";
	$reslieu = mysql_query($reqlieu)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				
			
	$req = "SELECT id, titre, duree, lieu, id_lieu, type, DATE_FORMAT(date, '%d/%m/%Y') AS dateEvent, duree, horaire_debut, horaire_fin, description FROM evenement WHERE date BETWEEN '$date2' AND '$date1' ORDER BY date";
  	$res = mysql_query($req)  or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	

			while($data4 = mysql_fetch_array($res4)){
				array_push($tabType_nomEvent, $data4["nom"]);
				array_push($tabType_numero, $data4["numero"]);
				array_push($tabType_color, $data4["color"]);
			}
			
			while($datalieu = mysql_fetch_array($reslieu)){
				array_push($tabLieu_nom, $datalieu["nom"]);
				array_push($tabLieu_numero ,$datalieu["numero"]);
			}
				
	while($data = mysql_fetch_array($res)){
		for($k=0; $k<$data['duree']; $k++){
		
			$newDate = explode("/",$data['dateEvent']);
			$newDate2 = mktime(0, 0, 0, $newDate[1], $newDate[0]+$k, $newDate[2]); 
			//echo date('d-m-Y',$newDate2).' - ';
			if(date('m',$newDate2) == $mois){
			
				if($data['id_lieu']==0){
					array_push($tabLieu, $data['lieu']);
				}
				else{
					for($i=0; $i<count($tabLieu_numero); $i++){
						if($tabLieu_numero[$i] == $data['id_lieu']){
							array_push($tabLieu, $tabLieu_nom[$i]);
							break;
						}
					}
				}
				array_push($tabTitre, $data['titre']);
				
					for($i=0; $i<count($tabType_numero); $i++){
						if($tabType_numero[$i] == $data['type']){
							array_push($tabType, $tabType_nomEvent[$i]);
							array_push($tabColor, hex2rgb(substr($tabType_color[$i],1)));
							break;
						}
					}
				
				array_push($tabDate, date('d/m/Y',$newDate2));
				array_push($tabDebut, $data['horaire_debut']);
				array_push($tabFin, $data['horaire_fin']);
			}
		}
	}

	$tabGlobal = array($tabTitre, $tabType, $tabLieu, $tabDebut, $tabFin);

mysql_close();

//Génération de la mise en PDF

class PDF extends UFPDF
{

//En-tÃªte
function Header()
{
    //Logo
    $this->Image('../../images/logoPDF.jpg',10,10, 40,12);
	
    $this->SetFont('Arial','B',7);
	$this->SetTextColor(0,0,0);
    //DÃ©calage Ã  droite
    $this->Cell(90);
    //Titre
    $this->Cell(30,10,$this->title,0,0,'C');
    //Saut de ligne
    $this->Ln(20);
}



function BasicTable($header, $data, $tabDate, $tabColor)
{

    $this->SetLineWidth(.3);
    $this->SetFont('Arial','',8);
   
   
	for($i=0; $i<count($tabDate); $i++){
		if($i!=0 && $i%5==0){
			$this->AddPage();
		}
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255,0,0);
		$this->SetDrawColor($tabColor[$i][0],$tabColor[$i][1], $tabColor[$i][2]);
		
		$this->Cell(30);
		$this->Cell(0,10,$tabDate[$i]." :",0);
		
		$this->Ln(8);
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);

		for($j=0; $j<count($header); $j++){
			$this->SetTextColor(70,70,70);
			$this->Cell(30);
			$this->Cell(15, 7, $header[$j],1,0);
			$this->SetTextColor(0,0,0);
			$this->Cell(90, 7, $data[$j][$i],1,0);
			$this->Ln();
		}
		
		$this->Ln(5);
	}
}


//Pied de page
function Footer()
{
    //Positionnement Ã  1,5 cm du bas
    $this->SetY(-15);

    $this->SetFont('Arial','I',8);
	$this->SetTextColor(30,30,30);
 
	$this->Cell(170,10,'Copyright Â© SESQUIDISTUS ',0,0);
$this->SetFont('Arial','I',7);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0);
}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetTitle($titre);
$pdf->SetAuthor('SESQUIDISTUS');
$pdf->AddPage();
$header=array('Nom','Type','Lieu','DÃ©but','Fin');

$pdf->BasicTable($header,$tabGlobal, $tabDate, $tabColor);

$pdf->Output();

?>