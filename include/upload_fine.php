<?php
var_dump($_POST);
// Retrieve the variables from the POST request
$received_variable1 = $_POST['variable1'];
$received_variable2 = $_POST['variable2'];
$received_variable3 = $_POST['variable3'];

// Your PHP code here, using $received_variable1, $received_variable2, $received_variable3 as needed
echo "Variable 1 received from Python: " . $received_variable1 . "<br>";
echo "Variable 2 received from Python: " . $received_variable2 . "<br>";
echo "Variable 3 received from Python: " . $received_variable3 . "<br>";