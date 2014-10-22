<?php

/*
 * index.php
 * Used to demonstrate the imageBoss.php library.
 */

// Load in the imageBoss library.
include('imageBoss.php');

// Init the library and default parameters.
$image = new imageBoss;
$image->inputDirectory = dirname(__FILE__) . '/images/originals/';
$image->outputDirectory = dirname(__FILE__) . '/images/cache/';
$image->prefix = 'demo_';
ini_set('memory_limit', '64M');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>index.php - imageBoss Documentation</title>
	</head>
	<body>
		<h2>imageBoss.php - Information</h2>
		<p>imageBoss.php is a PHP library used to reize images on the fly, with caching support built-in. Simply specifiy an input and output directory, define a file prefix, and you're ready to go.</p>
		<ul>
			<li>This library is free, and licensed under MIT, so this can be used for any project of any type.</li>
			<li>Supports JPG, PNG, and GIF images.</li>
			<li>Includes images for demonstration taken from the <a href="https://github.com/Foggalong/OpenWall" target="_blank">OpenWall Github repository</a>. The specific photos used were taken in <a href="http://centrevilletech.com" target="_blank">Centreville, AL.</a></li>
		</ul>
		<h2>imageBoss.php - Demonstration</h2>
		<p>This demonstration shows TWO ways we could serve originally full-size images to the end-user. The first approach uses standard CSS for scaling, and transmits the original fullsize image to the browser. The second approach, uses the imageBoss.php library to resize the images before sending to the end user, and will then store the resized images to serve again and again as needed, without using unneccesary server resources.</p>
		<h3>Originals (Scaled to 300 x 300 with inline CSS.)</h3>
		<img src="images/originals/CitySidewalk.png" style="width: 300px; height: 300px;" />
		<img src="images/originals/CountryGrass.png" style="width: 300px; height: 300px;" />
		<h3>Resized Versions (Actual size is 300 x 300 after processing. No CSS scaling needed.)</h3>
		<img src="images/cache/<?php echo $image->resizeImage(300, 300, 'CitySidewalk.png'); ?>" />
		<img src="images/cache/<?php echo $image->resizeImage(300, 300, 'CountryGrass.png'); ?>" />
		<h2>imageBoss.php - How To Use</h2>
		<p><emphasis>View the source for index.php for a demonstration.</emphasis></p>
		<p><emphasis>See README.md for more information.</emphasis></p>
		<h2>imageBoss.php - Planned Features</h2>
		<ul>
			<li>Add support for retina images to be created automatically.</li>
			<li>Add support for additional file types.</li>
			<li>Increase processing performance.</li>
			<li>Reduce required server memory.</li>
			<li>Re-write <a href="README.md" target="_blank">README.md</a>.</li>
		</ul>
		<h2>imageBoss.php - Support</h2>
		<p>If you get stuck and need help using the library, send Joshua Lambert an email at <a href="mailto:hi@centrevilletech.com">hi@centrevilletech.com</a>.<p>
		<br />
		<hr />
		<p>Originally written By: Joshua Lambert &mdash; <a href="http://centrevilletech.com" target="_blank">CentrevilleTech.com</a></p>
	</body>
</html>
<?php
/*
 * EOF
 */
?>