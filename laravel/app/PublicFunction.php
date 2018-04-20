<?php

class PublicFunction{
	/*
	*map_report $name is the map name,$data is an array whith keys and values
	**/
	public static function map_report($name,$datas){
		$img = imagecreatefrompng($name);
		imagestring($img, 5, 20, 20, $name, imagecolorallocate($img, 0, 0, 0));
		header('Content-type: image/PNG');
		imagepng($img,$dir);
	}


}