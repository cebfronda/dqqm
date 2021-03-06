<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the "Database Connection"
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|
| The $active_group variable lets you choose which connection group to
| make active.  By crm there is only one group (the "crm" group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = "crm";
$active_record = TRUE;

$db['crm']['hostname'] = "localhost";
$db['crm']['username'] = "root";
$db['crm']['password'] = "";
$db['crm']['database'] = "dq_crm";
$db['crm']['dbdriver'] = "mysql";
$db['crm']['dbprefix'] = "";
$db['crm']['pconnect'] = TRUE;
$db['crm']['db_debug'] = TRUE;
$db['crm']['cache_on'] = FALSE;
$db['crm']['cachedir'] = "";
$db['crm']['char_set'] = "utf8";
$db['crm']['dbcollat'] = "utf8_general_ci";

$db['vicidial']['hostname'] = "116.50.225.92:3306";
$db['vicidial']['username'] = "root";
$db['vicidial']['password'] = "";
$db['vicidial']['database'] = "asterisk";
$db['vicidial']['dbdriver'] = "mysql";
$db['vicidial']['dbprefix'] = "";
$db['vicidial']['pconnect'] = TRUE;
$db['vicidial']['db_debug'] = TRUE;
$db['vicidial']['cache_on'] = FALSE;
$db['vicidial']['cachedir'] = "";
$db['vicidial']['char_set'] = "utf8";
$db['vicidial']['dbcollat'] = "utf8_general_ci";


/* End of file database.php */
/* Location: ./system/application/config/database.php */