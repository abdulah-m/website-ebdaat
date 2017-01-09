<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 13/04/2015
 * Time: 03:43 ص
*/

/* Define MySQL connection details and database table name */ 
$SETTINGS["hostname"] = 'localhost';
$SETTINGS["mysql_user"] = 'root';
$SETTINGS["mysql_pass"] = '';
$SETTINGS["mysql_database"] = 'ebdaat';
$SETTINGS["USERS"] = 'php_users_login'; // this is the default table name that we used

/* Connect to MySQL */
$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');

mysql_query("SET character_set_client=utf8"); 
mysql_query("SET character_set_connection=utf8"); 
mysql_query("SET character_set_database=utf8"); 
mysql_query("SET character_set_results=utf8"); 
mysql_query("SET character_set_server=utf8");  
mysql_query("SET NAMES utf8"); 
mysql_query("set CHARACTER set 'utf8'",$connection);
mb_internal_encoding("UTF-8");

$queryConfig    =   mysql_query("SELECT * FROM config")or die (mysql_error());
$ConfigSite     =   mysql_fetch_object($queryConfig);

define("s_name"			,$ConfigSite->s_name);
define("s_url"			,$ConfigSite->s_url);
define("s_email"		,$ConfigSite->s_email);
define("s_desc"			,$ConfigSite->s_desc);
define("s_key"			,$ConfigSite->s_key);
define("s_copy"			,$ConfigSite->s_copy);
define("s_mob"			,$ConfigSite->s_mob);
define("s_tel"			,$ConfigSite->s_tel);
define("s_address"		,$ConfigSite->s_address);
?>