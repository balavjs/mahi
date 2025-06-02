<?php
include('vendor/barcode/barcode.php');

// Generate and output the barcode image directly to browser
barcode("", "123456789012", 100, "horizontal", "code128", true);
?>