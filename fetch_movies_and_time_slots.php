<?php
include("connection.php");

if (isset($_GET['theatre_id'])) {
    $theatreId = $_GET['theatre_id'];

    // Fetch movies, theatres, and associated time slots based on the selected theatre
    $query = "SELECT
    m.name AS movie_name,
    m.category AS movie_category,
    s.slot AS time_slot
FROM
    `movie_schedule` ms
JOIN
    `movies` m ON ms.movie_id = m.id
JOIN
    `theatres` t ON ms.theatre_id = t.id
JOIN
    `slots` s ON ms.slot_id = s.id
WHERE
    t.id='$theatreId';
";
    $result = mysqli_query($con, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle error if theatre_id is not set
    echo json_encode(array('error' => 'Theatre ID is not set.'));
}
?>
