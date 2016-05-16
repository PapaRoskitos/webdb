<?php
//phpinfo();
const DB_DSN = 'pgsql:host=localhost;dbname=kicad';
const DB_USER = 'websrv';
const DB_PASS = 'gv.gv.';
//$inty = DB::query("SELECT * FROM users");
 
//echo "There are $inty rows";

$sql = 'SELECT * FROM users ORDER BY "Forename"';
$res = DB::query($sql);
    foreach (DB::query($sql) as $row) {
        print $row[Forename]. "\n";
    }


require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/** echo "BTRR"; */

$app = new \Slim\Slim();

/** echo "ABCRR"; */

$app->get('/', function () {
   $app = \Slim\Slim::getInstance();
   $app->response->write("Welcome to Slim !!");
});

$app->get('/foo/:id', function ($id) {
    echo "Foo! $id ";
});

$app->get('/hello/:name/:job', function ($name, $job) {
   $app = \Slim\Slim::getInstance();
   $app->response->write("Hello, $name is a $job");
});


$app->run();

class DB {
    

    
 private static $objInstance;
 
 private function __construct() {}
 
 private function __clone () {}
 
 public static function getInstance() {
     if(!self::$objInstance){
         self::$objInstance = new PDO(DB_DSN, DB_USER, DB_PASS);
         self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }
     return self::$objInstance;
 }
 
 final public static function __callStatic($chrMethod, $arrArguments) {
     $objInstance = self::getInstance();
     return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
 }
 
}

