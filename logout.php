<?php

// start session
session_start();

// kill the session
session_destroy();

// redirect back to website home
header('LOCATION: https://makemelive.in/facebook/' );

?>
