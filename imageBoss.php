<?php

/*
 * imageBoss.php
 * Used to process images on-the-fly using PHP.
 * Written By: Joshua Lambert (http://centrevilletech.com)
 * Based loosely on: https://gist.github.com/joshualambert/ae371301af6bfcf53712
 */

class imageBoss {

	// Used to set the default parameters for the class.
	function __construct() {
		$this->inputDirectory = dirname(__FILE__) . '';
		$this->outputDirectory = dirname(__FILE__) . '';
		$this->prefix = '_';
		$this->cacheEnabled = true;
	}

	// Used to resize an image based on a size and file parameter.
	public function resizeImage($newImageWidth = '', $newImageHeight = '', $imageFile = '') {
		// Verify required parameters are present.
		if ($newImageWidth === '' || $newImageHeight === '' || $imageFile === '') {
			$this->error('Required parameters not passed.');
			return;
		}
		// Verify the image passed in actually exsits.
		if (!file_exists($this->inputDirectory . $imageFile)) {
			$this->log('Image passed does not exist. Quietly aborting method.');
			return;
		}
		// Process the image if the file does not already exist, or if the config file is set to override any images.
		if (!file_exists($this->getOutputDirectory() . $this->getImagePrefix() . $imageFile) || $this->cacheEnabled === false) {
			$imageInfo = getimagesize($this->getInputDirectory() . $imageFile);
			switch ($imageInfo[2]) {
				case IMAGETYPE_GIF:
					$image = imagecreatefromgif($this->getInputDirectory() . $imageFile);
					break;
				case IMAGETYPE_JPEG:
					$image = imagecreatefromjpeg($this->getInputDirectory() . $imageFile);
					break;
				case IMAGETYPE_PNG:
					$image = imagecreatefrompng($this->getInputDirectory() . $imageFile);
					break;
				default:
					$this->error("Invalid image type (#{$type} = " . image_type_to_extension($type) . ")");
			}
			$thumbImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
			imagecopyresampled($thumbImage, $image, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imageInfo[0], $imageInfo[1]);
			switch ($imageInfo[2]) {
				case IMAGETYPE_GIF:
					imagegif($thumbImage, $this->getOutputDirectory() . $this->getImagePrefix() . $imageFile);
					break;
				case IMAGETYPE_JPEG:
					imagejpeg($thumbImage, $this->getOutputDirectory() . $this->getImagePrefix() . $imageFile, 90);
					break;
				case IMAGETYPE_PNG:
					imagepng($thumbImage, $this->getOutputDirectory() . $this->getImagePrefix() . $imageFile);
					break;
				default:
					$this->error("Invalid image type (#{$type} = " . image_type_to_extension($type) . ")");
			}
		}
		return $this->getImagePrefix() . $imageFile;
	}

	// Used to get a folder path for the file input directory.
	private function getInputDirectory() {
		if (!isset($this->inputDirectory)) {
			return $this->error('inputDirectory config variable not defined.');
		}
		return $this->inputDirectory;
	}

	// Used to get a folder path for the file output directory.
	private function getOutputDirectory() {
		if (!isset($this->outputDirectory)) {
			return $this->error('outputDirectory config variable not defined.');
		}
		return $this->outputDirectory;
	}

	// Used to get the prefix for new images. If one isn't defined, will return blank.
	private function getImagePrefix() {
		if (isset($this->prefix)) {
			return $this->prefix;
		} else {
			return '';
		}
	}

	// Used to show an error.
	private function error($error) {
		if (!isset($error)) {
			return;
		}
		$callers = debug_backtrace();
		die('(Error): imageResizer -> ' . $callers[1]['function'] . '() -> ' . $error);
	}

	// Used to send an error to the log file.
	private function log($message) {
		if (!isset($message)) {
			return;
		}
		$callers = debug_backtrace();
		error_log('(Log): imageResizer -> ' . $callers[1]['function'] . '() -> ' . $message);
	}

}

/*
 * EOF
 */

?>