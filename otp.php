<?php
require_once(__DIR__."mojoAuthAPI.php");
$mojoAuth = new mojoAuthAPI("test-9ccb64ee-d50d-42ba-bd4a-cbedcbca1dce");
//Step 1 Get Public Key / Certificate from MojoAuth Server
$result = $mojoAuth->getPublicKey();
$publicKey = json_decode($result);
//Step 2 Pass JWT token and publickey to verify user
$userProfileData =$mojoAuth->getUserProfileData($access_token,$publicKey->data)
?>