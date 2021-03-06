<option value="questions">Questions</option>
<?php

$LordsUrl = "http://www.lordswhips.org.uk/todays-lists/";
	// $LordsUrl = "http://leedhammedia.com/todays-lists/";
	$content = file_get_contents($LordsUrl);
	
	// Each list of speakers starts with the list
	$SplitOutSections = explode( '<p style="margin-left:36.0pt;"><strong>' , $content );
	// Remove the waffle at the beginning of the page
	if(count($SplitOutSections) == 1) {
		$SplitOutSections = explode('<em>Main Business</em>',$content);
		echo '<option value="0">List One</option><option value="1">List Two</option><option value="2">List Three</option>';
	} else {
		$SplitOutSections = array_slice($SplitOutSections,1);
		
		for($i=0; $i<count($SplitOutSections); $i++) {
			if(strpos($SplitOutSections[$i],"<em>Speakers</em>")) {
				$SplitOutSections[$i] = str_replace("followed by","",$SplitOutSections[$i]);
				$SplitOutSections[$i] = explode("</strong></p>",$SplitOutSections[$i]);
				$SplitOutSections[$i] = $SplitOutSections[$i][0];
				// Limit the size of the section titles
				$SplitOutSections[$i] = explode("&nbsp;",$SplitOutSections[$i]);
				$SplitOutSections[$i] = $SplitOutSections[$i][0];
			} else {
				$SplitOutSections[$i] = "";
			}
		}
		
		$SplitOutSections = array_values(array_filter($SplitOutSections));

		for($i=0; $i<count($SplitOutSections); $i++) {
			echo '<option value="'.$i.'">'.$SplitOutSections[$i].'</option>';
			
		}
		if(isset($i)){
			echo '<option value="'.($i).'">Manual List Number '.($i+1).'</option>';
		}

	}
?>