<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$tempUser = ( $_SESSION[ 'id' ] );
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Check if the user is logged in, if not then redirect him to login page
if ( !isset( $_SESSION[ "loggedin" ] ) || $_SESSION[ "loggedin" ] !== true ) {
  header( "location: ../Login/Login.php" );
  exit;
}
	
	?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	
	if ( $_POST[ "sendEmail" ] ) {
  include "../Config/config.php";
  
  $tempGroup = $_POST['group'];
  $subject = $_POST['subject'];
  $bodyText = $_POST['body'];	
   $tempEmailRec= $_POST['contact'];
	$query = "SELECT contact_email FROM contact WHERE user_id = '$tempUser' AND (contact_name='$tempEmailRec' OR contact_email = '$tempEmailRec')";
		$data = $link->query( $query );
		$rows = mysqli_fetch_assoc( $data );
		if($rows["contact_email"] != "")
		$recipient = $rows["contact_email"];
		else{
			$recipient = $tempEmailRec;
		}
		
  $sql = "SELECT email, first_name, last_name FROM users WHERE id = '$tempUser'";
  $result = $link->query( $sql );
  if ( $result->num_rows > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $email = $row[ 'email' ];
    $email = filter_var( $email, FILTER_SANITIZE_EMAIL );
    $email = filter_var( $email, FILTER_VALIDATE_EMAIL );
    $senderName = $row[ 'first_name' ] . " " . $row[ 'last_name' ];
// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'AKIA5SL74TMRGVYINPN4';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BJue2LyqV8sAcJTa+nMHeoNpO7H70DtgmMdMrYVPlEy+';

$host = 'email-smtp.us-east-2.amazonaws.com';
$port = 587;
 
$email_to = $recipient;
$fromserver = $email; 
include "../phpmailer/vendor/autoload.php";
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "email-smtp.us-east-2.amazonaws.com";
$mail->Username = "AKIA5SL74TMRGVYINPN4"; 
$mail->Password = "BJue2LyqV8sAcJTa+nMHeoNpO7H70DtgmMdMrYVPlEy+";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = $email;
$mail->FromName = $senderName;
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $bodyText;
$mail->AddAddress($email_to);
	$sql2 = "SELECT email1, email2, email3, email4, email5, email6, email7, email8, email9, email10 FROM groups WHERE id_user ='$tempUser' AND group_name = '$tempGroup'";
$result2 = $link->query( $sql2 );
$row = mysqli_fetch_array( $result2 );
for ( $i = 0; $i < 10; $i++ ) {
  if ($row[$i] != NULL){
    $mail->AddAddress($row[$i]);
  }
}  
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<script language='javascript' type='text/javascript'>location.href='../Home/home.php'</script>";
 }

	
	
		}
	}
	?>


</body>
</html>