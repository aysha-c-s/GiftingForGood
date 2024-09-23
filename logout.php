<?php

@include 'conf.php';

session_start();
session_unset();
session_destroy();

header('location:landing.html');

?>