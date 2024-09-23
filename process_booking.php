<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $selectedTheatreId = $_POST['theatre'];
    $selectedMovieTimeSlotId = $_POST['movieTimeSlot'];
    $selectedClassId = $_POST['Class'];
    $numberOfTickets = $_POST['tickets'];

    // Perform the database insertion
    $insertQuery = "INSERT INTO bookings (theatre_id, movie_time_slot_id, class_id, num_tickets)
                    VALUES ('$selectedTheatreId', '$selectedMovieTimeSlotId', '$selectedClassId', '$numberOfTickets')";

if (mysqli_query($con, $insertQuery)) {
    echo "Booking successful!";
} else {
    echo "Error: " . mysqli_error($con) . "<br>";
    echo "Query: " . $insertQuery;
}
} else {
    echo "Invalid request!";
}

?>
