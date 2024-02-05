<?php
// Simulated data for demonstration
$fineData = array(
    array('id' => 1, 'user_name' => 'John Doe', 'vehicle_number' => 'ABC123', 'license_number' => 'XYZ456', 'fine_amount' => '$50', 'paid' => 'No'),
    // Add more data as needed
);

// Output fine data in HTML format
foreach ($fineData as $fine) {
    echo '<tr>
            <td>' . $fine['id'] . '</td>
            <td>' . $fine['user_name'] . '</td>
            <td>' . $fine['vehicle_number'] . '</td>
            <td>' . $fine['license_number'] . '</td>
            <td>' . $fine['fine_amount'] . '</td>
            <td>' . $fine['paid'] . '</td>
        </tr>';
}
?>
