<?php


define( 'BLOB_WEB_PAGE_TO_ROOT', '' );
require_once BLOB_WEB_PAGE_TO_ROOT.'blob/includes/blobPage.inc.php';

$page = blobPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'About';
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>About</h1>

	<p>
	Version ".blobVersionGet()." (Release date: ".blobReleaseDateGet().")
	<br /><br />
	Greenify is a Free and OpenSource Microblogging client. All material is &copy; 2015
	</p>
</div>
";

$right = "
<center><strong>New to blob?</strong></center>
<br />
<div class=\"join\">
<form action=\"register.php\">
<input id=\"join\" value=\"Join!\" type=\"submit\">
</form>
</div><br />
<center><b>Already have a blob account?</b><br /><br />
<div class=\"join\">
<form action=\"login.php\">
<input id=\"login\" value=\"Login!\" type=\"submit\">
</form>
</div>
<br /><br />Easy, free, and instant updates. Get access to the information that interests you most.
";

if (blobIsLoggedIn())
  blobHtmlEcho( $page );
else
  blobNoLoginHtmlEcho( $page, $right );
?>
