<?php
    $hn='localhost';
    $db='main';
    $un='dominic';
    $pw="!Qaz@Wsx3#";

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {

        $connection = new PDO("mysql:host={$hn};dbname={$db};charset=utf8",$un, $pw);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage());
    }


    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        function undo_magic_quotes_gpc(&$array) {
            foreach($array as &$value) {
                if(is_array($value)) {
                    undo_magic_quotes_gpc($value);
                }
                else {
                    $value = stripslashes($value);
                }
            }
        }

        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
    }

    header('Content-Type: text/html; charset=utf-8');
?>
