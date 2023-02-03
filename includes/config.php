<?php

$DBHOST = "localhost";
$DBNAME = "rms";
$DBUNAME = "root";
$DBPASS = "";

$conn = new mysqli($DBHOST, $DBUNAME, $DBPASS, $DBNAME);

if (!$conn) {
    echo "Failed to connect to database";
}
