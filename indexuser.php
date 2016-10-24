<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sponsor Flip Wall With jQuery &amp; CSS | Tutorialzine demo</title>

<link rel="stylesheet" type="text/css" href="demo/styles.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="demo/jquery.flip.min.js"></script>

<script type="text/javascript" src="demo/script.js"></script>

</head>

<body>

<h1>Sponsor Flip Wall With jQuery &amp; CSS</h1>
<h2><a href="http://tutorialzine.com/2010/03/sponsor-wall-flip-jquery-css/">Go Back to the Tutorial &raquo;</a></h2>

<?php

// Each sponsor is an element of the $sponsors array:
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sqlget="SELECT threads.title, image.content,image.id ".
 "FROM threads LEFT JOIN image ".
	"ON threads.id = image.id";
	$sponsors= array();
	$index=0;
	if($getresult=mysqli_query($connect,$sqlget)){
	while($row=mysqli_fetch_array($getresult)){
	$sponsors[$index] = $row;			
		$index++;
	}
		
		}
// Randomizing the order of sponsors:

shuffle($sponsors);

?>



<div id="main">

	<div class="sponsorListHolder">

		
        <?php
			
			// Looping through the array:
			
			foreach($sponsors as $company)
			{
				echo'
				<div class="sponsor" title="Click to flip">
					<div class="sponsorFlip">
						<img src="data:image/jpeg;base64,'.base64_encode( $company[1] ).'"/>
					</div>
					
					<div class="sponsorData">
						<div class="sponsorDescription">
							'.$company[0].'
						</div>
						<div class="sponsorURL">
							<a href="'.$company[2].'">'.$company[2].'</a>
						</div>
					</div>
				</div>
				
				';

}

}
		?>

        
        
    	<div class="clear"></div>
    </div>

</div>

<p class="note">None of these companies are actually sponsors of Tutorialzine.</p>

</body>
</html>
