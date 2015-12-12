<?php

/*
 * blob is a micro-blogging service where you can share notices
 * about yourself with friends, family, and colleagues!
 *
 * Copyright (C) 2011  Avinash Joshi <avinashtjoshi@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define( 'BLOB_WEB_PAGE_TO_ROOT', '../' );
require_once BLOB_WEB_PAGE_TO_ROOT.'blob/includes/blobPage.inc.php';

blobPageStartup( array( 'authenticated', 'admin' ) );

$page = blobPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'View Status of users';
$page[ 'page_id' ] = 'viewstatus';

blobDatabaseConnect();
$user = blobCurrentUser();

if(isset($_GET['user']))
{
$user_id = $_GET['user'];
}
$user = blobGetUserName($user_id);
// Check if the user exists
if ( !blobExistUser($user) ) {
	blobMessagePush( "Sorry, but user does not exist!" );
}
$fullName = blobGetUserFullName($user);
$avatar = getAvatar($user);

$showStatusHTML = blobShowUserStatusbyID($user_id);

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>User Profile: {$user}</h2>

	<div class=\"vulnerable_code_area\">
		<div style=\"float: left; padding-right: 10px; border-right: 2px solid #C0C0C0;\">
			<img src=\"{$avatar}\" width=\"100\" />
		</div>
		<div style=\"margin-left: 120px;\">
			{$fullName}
		</div>
	</div>

	<div class=\"clear\"></div>
	<pre>User's status updates:</pre>
	{$showStatusHTML}
	<br /><br /><br />

</div>
";

blobHtmlEcho( $page );
?>
