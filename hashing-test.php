<?php
$password = "rasmuslerdorf";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash."<br>";

if ( password_verify($password, $hash) ) {
    echo "OK";
}
else {
    echo "KO";
}
