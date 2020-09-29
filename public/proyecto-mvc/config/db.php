<?php
/**
 *
 */
class DataBase 
{

  public static function connect(){

    $db = new mysqli('localhost','root','222','tienda_master');
$db->query("SETNAME 'utf8'");
return $db;
  }

}
