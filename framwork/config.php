<?php
// checking session alredy started or not
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/* making the connection for server and local both at time
 if you make the connection for server and local at time 
 does not need to go server and changer user name and password
 */

/*  checking which kind of hostname i getting
    if i getting localhost from the url simple 
    call the local database => username, password and database
    else if i not getting localhost simply call the server 
    database => username , password and database
*/

// host name of the database 
$hostname = '';

// username of the database
$username = '';

// password of the database for particular user
$password = '';

// database name you want connection with
$database = '';

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // for local connection
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "posigraph_socialplexus";
} else {
    // for server connection
    $hostname = "localhost";
    $username = "posigraph_socialplexus";
    $password = "Posigraph@123";
    $database = "posigraph_socialplexus";
}

/*   you can use the connection anywhere in your project does not need to
     make any others extra connection simply include this config file into 
     your .php  file 
*/
$conn = mysqli_connect($hostname, $username, $password, $database);
$con = mysqli_connect($hostname, $username, $password, $database);
