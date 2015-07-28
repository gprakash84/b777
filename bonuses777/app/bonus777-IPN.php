<?php
//test
ob_start();

require_once('site_config.php');


require('wp-blog-header.php');
//include('site-function/sendmail_functions.php');

error_reporting(1); 
global $userdata;  


if($_GET["secretkey"]=="WPU95319RTY")
{	

if($_GET["pgateway"]=="clickbank")
{
$name=$_POST['ccustfirstname']; 
$email=$_POST['ccustemail'];
}
if($_GET["pgateway"]=="wso" )
{
$name=$_POST['first_name'];
$email=$_POST['payer_email']; 
} 

if($_GET["pgateway"]=="jvzoo")
{
$name=$_POST['ccustname']; 
$email=$_POST['ccustemail'];
}


if($_GET["pgateway"]=="jvzoot")
{
$name=$_GET['ccustname']; 
$email=$_GET['ccustemail'];
}



$licensename = $_GET['Licensetype'];

$purchase_date = date("Y-m-d");

$usertype=$_GET['role'];

$user_id = username_exists( $email);
//echo "user id - $user_id <br/>";

if ( !$user_id ) 
{

//echo "User  - New user creation <br/>";

$random_password = wp_generate_password( 12, false );
$user_id = wp_create_user( $email, $random_password, $email );
$pass=$random_password;
$user = new WP_User($user_id);
$role=$usertype;
$user->set_role($role); 
$login_url="http://app.bonuses777.com/login";

$send_mail = create_premium_account_sendmail($email , $name , $pass , $login_url);

//echo "Mail sending - $send_mail <br/>";

}


if($usertype == "AffiliateOT1")
{
$user = new WP_User($user_id); 
$user->set_role($usertype);
$send_mail = create_ot1_sendmail($email , $name);
//echo "Mail sending - $send_mail <br/>";
}

if($usertype == "AffiliateOT2")
{
$user = new WP_User($user_id); 
$user->set_role($usertype);
$send_mail = create_ot2_sendmail($email , $name);
//echo "Mail sending - $send_mail <br/>";
}

} // END : secretkey

?>
