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

/*
 * This file contains all of the code to setup the initial MySQL database. (setup.php)
 *
 */

if( !@mysql_connect( $_BLOB[ 'db_server' ], $_BLOB[ 'db_user' ], $_BLOB[ 'db_password' ] ) ) {
	blobMessagePush( "Could not connect to the database - please check the config file." );
	blobPageReload();
}

// Create database
$drop_db = "DROP DATABASE IF EXISTS `blob`;";
if( !@mysql_query ( $drop_db ) ) {
	blobMessagePush( "Could not drop existing database<br />SQL: ".mysql_error() );
	blobPageReload();
}

$create_db = "CREATE DATABASE `blob`;";

if( !@mysql_query ( $create_db ) ) {
	blobMessagePush( "Could not create database<br />SQL: ".mysql_error() );
	blobPageReload();
}

blobMessagePush( "Database has been created." );

// Create table 'users'
if( !@mysql_select_db( $_BLOB[ 'db_database' ] ) ) {
	blobMessagePush( 'Could not connect to database.' );
	blobPageReload();
}

$create_tb = "CREATE TABLE users (user_id int(6) AUTO_INCREMENT,first_name varchar(15),last_name varchar(15), user varchar(20), password varchar(32), sec_key varchar(255) NOT NULL, follow text NOT NULL, isadmin int(1) DEFAULT '0' NOT NULL, avatar varchar(70), PRIMARY KEY (user_id)) ENGINE = InnoDB;";
if( !mysql_query( $create_tb ) ){
	blobMessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	blobPageReload();
}

blobMessagePush( "'users' table was created." );

//Cerate status table
$create_tb_status = "CREATE TABLE status (status_id mediumint(10) unsigned NOT NULL AUTO_INCREMENT, user_id int(6), status varchar(150) NOT NULL, date_set datetime NOT NULL, PRIMARY KEY (status_id), INDEX(user_id), FOREIGN KEY (user_id) REFERENCES users(user_id) on update cascade on delete cascade ) ENGINE = InnoDB;";

if( !mysql_query( $create_tb_status ) ){
	blobMessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	blobPageReload();
}

blobMessagePush( "'status' table was created." );

//Setup complete and successful
blobMessagePush( "Setup successful!" );
blobPageReload();

?>
