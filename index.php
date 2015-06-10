<?php
/*	FACEBOOK LOGIN BASIC - PHP SDK V4.0
*	file 			- index.php
* 	Developer 		- SHARIK SHAIKH
*	Website			- https://makemelive.in/
*	Date 			- 10th June 2015
*	license			- GNU General Public License version 3
*/


/* INCLUSION OF srcRARY FILEs*/
require_once( 'src/Facebook/FacebookSession.php');
require_once( 'src/Facebook/FacebookRequest.php' );	
require_once( 'src/Facebook/FacebookResponse.php' );
require_once( 'src/Facebook/FacebookSDKException.php' );
require_once( 'src/Facebook/FacebookRequestException.php' );
require_once( 'src/Facebook/FacebookRedirectLoginHelper.php');
require_once( 'src/Facebook/FacebookAuthorizationException.php' );
require_once( 'src/Facebook/GraphObject.php');
require_once( 'src/Facebook/GraphLocation.php');
require_once( 'src/Facebook/GraphUser.php' );
require_once( 'src/Facebook/GraphSessionInfo.php' );
require_once( 'src/Facebook/Entities/AccessToken.php');
require_once( 'src/Facebook/HttpClients/FacebookCurl.php' );
require_once( 'src/Facebook/HttpClients/FacebookHttpable.php');
require_once( 'src/Facebook/HttpClients/FacebookCurlHttpClient.php');


require_once 'autoload.php';



/* USE NAMESPACES */

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphLocation;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;
/*PROCESS*/

//1.Stat Session
session_start();
//2.Use app id,secret and redirect url
$app_id = '1834526790106878';
$app_secret = '6db333c75825373f87c8bc96044d047e';
$redirect_url='https://makemelive.in/facebook/';

//3.Initialize application, create helper object and get fb sess
FacebookSession::setDefaultApplication($app_id,$app_secret);

$helper = new FacebookRedirectLoginHelper($redirect_url);


//print_r($helper);
$session = $helper->getSessionFromRedirect();
//4. if fb sess exists echo name 
if(isset($session)){
//create request object,execute and capture response


echo '<a href="' . $helper->getLogoutUrl( $session, 'https://makemelive.in/facebook/logout.php' ) . '">Logout</a>';



try {
$me = (new FacebookRequest(
$session, 'GET', '/me'
))->execute()->getGraphObject(GraphUser::className());
echo $me->getName();
} catch (FacebookRequestException $e) {
error_log($e);
$user = null;
} catch (\Exception $e) {
error_log($e);
$user = null;
}

}

else
{
//else echo login
echo '<a href='.$helper->getLoginUrl().'>Login with facebook</a>';

}