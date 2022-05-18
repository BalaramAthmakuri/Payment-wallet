<?php
session_start();
$elec = $_POST['electric'];
$_SESSION["electprovider"] = $elec;
include 'electricitybill2.html';
?>