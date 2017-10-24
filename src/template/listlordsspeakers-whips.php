<?php

	$LordsUrl = "http://www.lordswhips.org.uk/todays-lists/";
	// $LordsUrl = "http://leedhammedia.com/todays-lists/";
	$content = file_get_contents($LordsUrl);
	
	// Each list of speakers starts with the list
	$SplitOutSpeakers = explode( '<em>Speakers</em>:' , $content );
	// Remove the waffle at the beginning of the page
	$SplitOutSpeakers = array_slice($SplitOutSpeakers,1);
	// Remove the waffle at the end of the page
	$KeepGoodStuff = explode('<em>Notes:</em>',$SplitOutSpeakers[count($SplitOutSpeakers)-1]);
	$SplitOutSpeakers[count($SplitOutSpeakers)-1] = $KeepGoodStuff[0];

	// print_r($SplitOutSpeakers);
	$NewSpeakers = array();
	
	// For each set of speakers... 
	for($i=0; $i<count($SplitOutSpeakers); $i++) {
		$SplitOutSpeakers[$i] = str_replace('<p style="margin-left:70.9pt;">',"",$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('<em>(Maiden speech)</em>','',$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('<em>(Maiden Speech)</em>','',$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('&#39;','\'',$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('<p>&nbsp;&nbsp;',"",$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('&nbsp;&nbsp&nbsp;',"",$SplitOutSpeakers[$i]);		
		$SplitOutSpeakers[$i] = str_replace('&nbsp;&nbsp;',"",$SplitOutSpeakers[$i]);	
		$SplitOutSpeakers[$i] = str_replace('&nbsp;','. ',$SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace("\n",'', $SplitOutSpeakers[$i]);	
		$SplitOutSpeakers[$i] = preg_replace('/[0-9]+/', '', $SplitOutSpeakers[$i]);
		$SplitOutSpeakers[$i] = str_replace('<p>.','',$SplitOutSpeakers[$i]);
			
		// Make list of individual speakers into subarrays
		$SplitOutSpeakers[$i] = explode('</p>',$SplitOutSpeakers[$i]); 
		// For each speaker
		for ($j=0; $j<count($SplitOutSpeakers[$i]); $j++) {
			$SplitOutSpeakers[$i][$j] = str_replace('<p>','',$SplitOutSpeakers[$i][$j]);
			$SplitOutSpeakers[$i][$j] = trim($SplitOutSpeakers[$i][$j]);
			$SplitOutSpeakers[$i][$j] = explode('. ',$SplitOutSpeakers[$i][$j]);
			if(count($SplitOutSpeakers[$i][$j]) < 2 ) { 
			} else {
				$SplitOutSpeakers[$i][$j] = trim($SplitOutSpeakers[$i][$j][1]).', '.trim($SplitOutSpeakers[$i][$j][0]).'.';
			}
			// Ignore sub-sub arrays as they can't be speakers...	
			if(!is_array($SplitOutSpeakers[$i][$j])) {
				// Remove any single elements which are descriptions
				if(!strpos($SplitOutSpeakers[$i][$j],'<em>') && !strpos($SplitOutSpeakers[$i][$j],'</strong>') && !strpos($SplitOutSpeakers[$i][$j],'<strong>')) {
					$NewSpeakers[$i][$j] = $SplitOutSpeakers[$i][$j];
				}
			}
		} 
	}
	// Reindex array from 0-n. 
	for($i=0; $i<count($NewSpeakers); $i++) {
		$NewSpeakers[$i] = array_values($NewSpeakers[$i]);
	}			

	$LordsSpeakers = $NewSpeakers;	

?>