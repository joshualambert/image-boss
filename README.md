imageBoss.php - README.

Here's a basic code example for using the library:

<?php

// Load in the imageBoss library.
include('imageBoss.php');

// Init the library and default parameters.
$image = new imageBoss;
$image->inputDirectory = dirname(__FILE__) . '/images/originals/';
$image->outputDirectory = dirname(__FILE__) . '/images/cache/';
$image->prefix = 'demo_';
ini_set('memory_limit', '64M');

?>

<img src="images/cache/<?php echo $image->resizeImage(300, 300, 'CitySidewalk.png'); ?>" />

For more information, check out the LIVE DEMO in index.php.