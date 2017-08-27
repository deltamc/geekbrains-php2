<?php 
function create_thumbnail($path, $save, $width, $height) {
	$info = getimagesize($path); //получаем размеры картинки и ее тип


        //В зависимости от расширения картинки вызываем соответствующую функцию
	if ($info['mime'] == 'image/png') {
		$src = imagecreatefrompng($path); //создаём новое изображение из файла
	} else if ($info['mime'] == 'image/jpeg') {
		$src = imagecreatefromjpeg($path);
	} else if ($info['mime'] == 'image/gif') {
 		$src = imagecreatefromgif($path);
	} else {
		return false;
	}

	$thumb = imagecreatetruecolor($width, $height);

	imageSaveAlpha($thumb,     true);


	$widthOld  =  $info[0];
	$heightOld =  $info[1];

	$ratio = $width/$height;

	$src_ratio=$widthOld/$heightOld;

	if(($widthOld > $width || $heightOld > $height)) {
		if ($ratio<$src_ratio) {
			$height = $width/$src_ratio;
		} else {
			$width = $height*$src_ratio;
		}

	} else {
		$height = $width/$src_ratio;
	}







	$trans_colour = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
	imagefill($thumb, 0, 0, $trans_colour);

	imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, $info[0], $info[1]);

	if($save === false) {
		return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
	} else {
		return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
	}

}