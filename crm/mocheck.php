<?php

function cleanMobileNumber($phoneNumber) {
    // Remove spaces
    $phoneNumber = str_replace(' ', '', $phoneNumber);

    // Remove leading '+' and '91'
    $phoneNumber = preg_replace('/^(\+|91)/', '', $phoneNumber);

    return $phoneNumber;
}

// Example usage:
$mobileNumber = '+91 123 456 7890';
$cleanedNumber = cleanMobileNumber($mobileNumber);

echo "Original number: $mobileNumber\n";
echo "Cleaned number: $cleanedNumber\n";

?>
