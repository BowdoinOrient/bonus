<?php

// Loads the class
require 'browscap/Browscap.php';

// The Browscap class is in the phpbrowscap namespace, so import it
//use phpbrowscap\Browscap;

// Create a new Browscap object (loads or creates the cache)
$bc = new Browscap('browscap/cache/');

// Get information about the current browser's user agent
$current_browser = $bc->getBrowser();

// Output the result
echo '<pre>'; // some formatting issues ;)
print_r($current_browser);
echo '</pre>';