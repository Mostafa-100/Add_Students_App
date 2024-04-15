<?php

define("HOSTNAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "school");

$connect = mysqli_connect(HOSTNAME, USER_NAME, PASSWORD, DB_NAME);

if(mysqli_connect_error()) {
    exit("Failed to connect to database");
}

