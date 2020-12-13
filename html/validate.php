<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );
session_start();
$tempEmail = $_SESSION['email'];
require('/var/www/html/vendor/autoload.php') ;

use Aws\Ses\SesClient; 
use Aws\Exception\AwsException;

$SesClient = new Aws\Ses\SesClient([
    'version'     => 'latest',
    'region'      => 'us-east-2',
    'credentials' => [
        'key'    => 'AKIAIVDFTCE4J7TMAKQQ',
        'secret' => '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',
    ],
]);

$email = $tempEmail;

try {
    $result = $SesClient->verifyEmailIdentity([
        'EmailAddress' => $email,
    ]);
    var_dump($result);
	header("location:/Login/Login.php");
} catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}


?>