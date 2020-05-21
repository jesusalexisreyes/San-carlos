<?php

// The version number (9_5_0) should match version of the Chilkat extension used, omitting the micro-version number.
// For example, if using Chilkat v9.5.0.48, then include as shown here:
include("chilkat_9_5_0.php");

// This example assumes the Chilkat API to have been previously unlocked.
// See Global Unlock Sample for sample code.

$crypt = new CkCrypt2();

$clearText = 'The quick brown fox jumps over the lazy dog';

$password = 'password';
$hexEncryptedStr = $crypt->mySqlAesEncrypt($clearText,$password);
print $hexEncryptedStr . "\n";
$decryptedStr = $crypt->mySqlAesDecrypt($hexEncryptedStr,$password);
print $decryptedStr . "\n";

$password = 'a';
$hexEncryptedStr = $crypt->mySqlAesEncrypt($clearText,$password);
print $hexEncryptedStr . "\n";
$decryptedStr = $crypt->mySqlAesDecrypt($hexEncryptedStr,$password);
print $decryptedStr . "\n";

$password = '1234567890123456';
$hexEncryptedStr = $crypt->mySqlAesEncrypt($clearText,$password);
print $hexEncryptedStr . "\n";
$decryptedStr = $crypt->mySqlAesDecrypt($hexEncryptedStr,$password);
print $decryptedStr . "\n";

$password = 'abcdefghijklmnopqrstuvwxyz';
$hexEncryptedStr = $crypt->mySqlAesEncrypt($clearText,$password);
print $hexEncryptedStr . "\n";
$decryptedStr = $crypt->mySqlAesDecrypt($hexEncryptedStr,$password);
print $decryptedStr . "\n";

?>
