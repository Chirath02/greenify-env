<?php

define( 'BLOB_WEB_PAGE_TO_ROOT', '../../' );
require_once BLOB_WEB_PAGE_TO_ROOT.'blob/includes/blobPage.inc.php';

blobPageStartup( array( 'authenticated' ) );

$page = blobPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Get flag!!!';
$page[ 'page_id' ] = 'home';
blobDatabaseConnect();

function details($user){
	$query  = "SELECT sec_key FROM users where user = '$user'";
	$result = @mysql_query($query) or die('<pre>' . mysql_error() . '</pre>' );
	if( $result && mysql_num_rows( $result ) == 1 ) {
		$row = mysql_fetch_row($result);
		return $row[0];
	} else {
		return ( null );
	}
}

if(isset($_GET['user']))
{

$user = $_GET['user'];

$page[ 'body' ] .= details($user);
} else {


$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>No Comments!</h2>


</div>
";
}

blobHtmlEcho( $page );
?>