<?php

// Use exec or shell_exec to run the Python script
// Get the absolute path of the current script's directory
$scriptDirectory = __DIR__;

// Construct the path to the Python script
$pythonScriptPath = realpath($scriptDirectory . '/../Arduino/messagePayFine.py');

// Use shell_exec to run the Python script
$output = shell_exec('python ' . escapeshellarg($pythonScriptPath));

// Output the result
header("Location: pay_fine.php");