<?php
function uploadImage($files, $dir, $maxSize)
{

    static $count = 0;
    $count++;
    if(!preg_match('/\/$/',$dir)) $dir .= '/';

    $imageTypes = array
    (
         'image/gif'  => 'gif',
         'image/jpeg' => 'jpeg',
         'image/png'  => 'png',
    );

    $out = array(
        'error' => '',
        'file'  => ''
    );

    if (!isset($_FILES[$files])) {
        $out['error'] = 'Файл не загружен';
        return $out;
    }

    $fileTmpName  = $_FILES[$files]['tmp_name'];
    $fileType     = $_FILES[$files]['type'];


    if (!is_uploaded_file($fileTmpName)) {
        $out['error'] = 'Ошибка загрузки файла ';
        return $out;
    }

    if(filesize($fileTmpName) > $maxSize) {
        $out['error'] = 'Превышен максимальный размер файла';
        return $out;
    }

    if(!isset($imageTypes[$fileType])) {

        $out['error'] = 'Файл не является картинкой';
        return $out;
    }


    $out['file'] = md5(time().$count.rand(0,1000)).'.'.$imageTypes[$fileType];

    if (!move_uploaded_file($fileTmpName, $dir.$out['file'])) {
        $out['error'] = 'Ошибка загрузки файла ';
        return $out;
    }
    return $out;

}