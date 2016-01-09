<?php
/**
 * Created by PhpStorm.
 * User: pamba
 * Date: 10/17/2015
 * Time: 8:52 PM
 */

require 'config.php';

try {
    //echo "start";
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );



    $sth = $db->prepare("SELECT * FROM vehicle_table");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);

    $json = json_encode( $result);
    echo ($json);






} catch (Exception $e) {
    echo $e->getMessage();
}
