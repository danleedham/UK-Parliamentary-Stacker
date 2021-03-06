<?php

/* whoparty.php 
*  Version 1.0 
*  04/10/2017 
*  This file generates the list of current political parties in the chosen house 
*  Option to show who members there are in each party is dependent on the file query
*  Output is a list of option HTML tags
*/

if(!isset($house) && isset($_GET['house'])){
	$house = $_GET["house"];
}
if(!isset($house)){
	$house = "Commons";
}
if(!isset($sex) && isset($_GET['sex'])){
	$sex = $_GET["sex"];
}
if(!isset($sex)){
	$sex = "both";
}

$xmlDoc=new DOMDocument();
$xmlDoc->load("http://data.parliament.uk/membersdataplatform/services/mnis/HouseOverview/".$house."/".date("Y-m-d")."/");
$x=$xmlDoc->getElementsByTagName('Party');
$partycount = $x->length;	
if ($partycount == 0) {
} else {	
	for($i=0; $i<($x->length); $i++) {
		$Name = $x->item($i)->getElementsByTagName('Name');				
		$MaleCount = $x->item($i)->getElementsByTagName('MaleCount');
		$FemaleCount = $x->item($i)->getElementsByTagName('FemaleCount');
		$TotalCount = $x->item($i)->getElementsByTagName('TotalCount');
		if ($sex == "m") {
			$count = $MaleCount->item(0)->textContent;
		} elseif ($sex == "f") {
			$count = $FemaleCount->item(0)->textContent;
		} else { 
			$count = $TotalCount->item(0)->textContent;
		}
		
	if (!$count == 0) { 				
			$PartyName=trim($Name->item(0)->textContent);  
			$partyarray[] = array('Name'  => $PartyName,
    							  'Seats' => $count);
			}
	}
	echo '<option value="">All Parties</option>';
	foreach ($partyarray as $key => $value) {
	   echo '<option value="'. $value["Name"].'">'. $value["Name"].'</option>';
	}

}
?>
