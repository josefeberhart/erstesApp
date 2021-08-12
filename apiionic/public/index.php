<?php
//neu am 11.8.2021
//header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, POST, DELETE, OPTIONS");
header('Access-Control-Max-Age: 86400');
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Headers: *");

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// # include DB connection file
require '../src/config/db.php';

$app = new \Slim\App;

  


// create POST HTTP request neuen Benutzer anlegen
$app->post('/signup', function( Request $request, Response $response){

    // get the parameter from the form submit
    $vorname = $request->getParam('vorname');
    $nachname = $request->getParam('nachname');
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    $telefon = $request->getParam('telefon');
    $strasse = $request->getParam('strasse');
    $plz = $request->getParam('plz');
    $ort = $request->getParam('ort');
    $password = md5($password);


    $sql = "INSERT INTO users (vorname, nachname, email, password, telefon, strasse, plz, ort)
    VALUES(:vorname,:nachname,:email,:password,:telefon,:strasse,:plz,:ort)";

    try {
      // Get DB Object
      $db = new db();

      // connect to DB
      $db = $db->connect();

      // https://www.php.net/manual/en/pdo.prepare.php
      $stmt = $db->prepare( $sql );

      // bind each paramenter
      // https://www.php.net/manual/en/pdostatement.bindparam.php
      
      $stmt->bindParam(':vorname', $vorname);
      $stmt->bindParam(':nachname', $nachname);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':telefon', $telefon);
      $stmt->bindParam(':strasse', $strasse);
      $stmt->bindParam(':plz', $plz);
      $stmt->bindParam(':ort', $ort);
   
      // execute sql
      $stmt->execute();

      // return the message as json format
      echo '{"notice" : {"msg" : "Registrierung abgeschlossen.."}';

    } catch( PDOException $e ) {

      // return error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }

   });
    

// create POST HTTP request zum Login

session_start();

$app->post('/login', function( Request $request, Response $response){

  $email = $request->getParam('email');
  $password = $request->getParam('password');
    $password = md5($password);

  $result = array();

  $sql = "SELECT password, email FROM users WHERE email = :email";

// Get DB Object
$db = new db();

// connect to DB
$db = $db->connect();

// https://www.php.net/manual/en/pdo.prepare.php
$stmt = $db->prepare( $sql );

  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $login = $stmt->fetch();

  $db_psw = $login['password'];

// if(password_verify($password, $db_psw))

  if ($password == $db_psw)
  {
    $_SESSION['user'] = "";
    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $userdata = $stmt->fetch();
      
    $result['error'] = false;
    $result['email'] = $userdata['email'];
    $result['password'] = $userdata['password'];

  }
else {
  $result['error'] = true;
  $result['message'] = 'Falsches Passwort';
}

if(!$login) {
  $result['error'] = true;
  $result['message'] = 'Benutzer nicht vorhanden';
}

  return $this->response->withJson($result);

 });


    // create GET HTTP request für alle Benutzer
$app->get('/beraters', function( Request $request, Response $response){
    // echo 'Benutzer';
  
    $sql = "SELECT vorname, nachname FROM users";
  
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
      // query
      $stmt = $db->query( $sql );
      $customers = $stmt->fetchAll( PDO::FETCH_OBJ );
      $db = null; // clear db object
  
      // print out the result as json format
      echo json_encode( $customers );    
  
      
    } catch( PDOException $e ) {
  
      // show error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
  
  });



    // create GET HTTP request für alle Benutzer
$app->get('/projekte', function( Request $request, Response $response){
    // echo 'Benutzer';
  
    $sql = "SELECT * FROM tblProjekte";
  
    try {
      // Get DB Object
      $db = new db();
  
      // connect to DB
      $db = $db->connect();
  
      // query
      $stmt = $db->query( $sql );
      $projekt = $stmt->fetchAll( PDO::FETCH_OBJ );
      $db = null; // clear db object
  
      // print out the result as json format
      echo json_encode( $projekt );    
  
      
    } catch( PDOException $e ) {
  
      // show error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
  
  });



    
// create POST HTTP request zum Neuanlegen von einem Projekt
$app->post('/projektneu', function( Request $request, Response $response){

    // get the parameter from the form submit
    $titel = $request->getParam('Titel');
    $kurzbeschreibung = $request->getParam('Kurzbeschreibung');
    $detailbeschreibung = $request->getParam('Detailbeschreibung');
    $organisation = $request->getParam('Organisation');
    $budget = $request->getParam('Budgetvorschlag');
    $thema = $request->getParam('Thema');
        
    
    $sql = "INSERT INTO tblProjekte (Titel, Kurzbeschreibung, Detailbeschreibung, Organisation, Budgetvorschlag, Thema) 
VALUES(:titel,:kurzbeschreibung,:detailbeschreibung,:organisation,:budget,:thema)";
   
    try {
      // Get DB Object
      $db = new db();
   
      // connect to DB
      $db = $db->connect();
   
      // https://www.php.net/manual/en/pdo.prepare.php
      $stmt = $db->prepare( $sql );
   
      // bind each paramenter
      // https://www.php.net/manual/en/pdostatement.bindparam.php
      $stmt->bindParam(':titel', $titel);
      $stmt->bindParam(':kurzbeschreibung', $kurzbeschreibung);
      $stmt->bindParam(':detailbeschreibung', $detailbeschreibung);
      $stmt->bindParam(':organisation', $organisation);
      $stmt->bindParam(':budget', $budget);
      $stmt->bindParam(':thema', $thema);
         
      // execute sql
      $stmt->execute();
      
      // return the message as json format
      echo '{"notice" : {"msg" : "Registrierung abgeschlossen.."}';
   
    } catch( PDOException $e ) {
   
      // return error message as Json format
      echo '{"error": {"msg": ' . $e->getMessage() . '}';
    }
   
   });



$app->run();
