<?php
/**
 * Получить результат в виде ассоциативного массива
 * @param $sql
 * @param null $db
 * @return array
 */
function getAssocResultAll($sql, $db = null){
    if ($db == null) {
        $db = getConnection();
    }

	$result = mysqli_query($db, $sql);
	$array_result = array();

	while($row = mysqli_fetch_assoc($result)) {
        $array_result[] = $row;
    }

	return $array_result;
}

/**
 * Получить одну строку
 * @param $sql
 * @param null $db
 * @return array|mixed
 */
function getAssocResultOne($sql, $db = null) {
    if ($db == null) {
        $db = getConnection();
    }

    $result = getAssocResultAll($sql, $db);
    if (!empty($result) && is_array($result)) {
        return $result[0];
    }

    return array();
}

/**
 * Выполнить соединение с базой
 * @return mysqli
 */
function getConnection(){
    //хак, чтобы не поднимать каждый раз соединение
    static $db = null;

    if ($db == null) {
        $db = mysqli_connect(HOST, USER, PASS, DB);
        mysqli_query($db, "SET NAMES utf8");
    }

    if (!mysqli_ping($db)) {
        $db = null;
        $db = getConnection();

        if (!mysqli_ping($db)) {
            trigger_error("Ошибка подключения к базе", E_ERROR);
        }
    }

    return $db;
}

/**
 * Выполнить запрос
 * @param $sql
 * @param null $db
 * @return bool|mysqli_result
 */
function executeQuery($sql, $db = null){
    if($db == null){
        $db = getConnection();
    }

	$result = mysqli_query($db, $sql);

	return $result;
}

/** Получить последний ID
 * @return int|string
 */
function getLastId() {
    $db = getConnection();
    return mysqli_insert_id($db);
}

/**
 * Выполнить экранирование строки
 * @param $str
 * @param null $db
 * @return string
 */
function escapeString($str, $db = null) {
    if ($db == null) {
        $db = getConnection();
    }

    $res = mysqli_real_escape_string($db, $str);

    return $res;
}


function hashPass($pass) {
//    $salt = 'asdkljhf78yaesw8ft28gf8asgf8i2gqf82737gaigs78';
//    $salt2 = 'sdf899ty7d7856fgy32fg78g';
//    return md5(md5($salt2 . $pass . $salt));

    return md5($pass);
}