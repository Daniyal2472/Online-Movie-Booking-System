<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #1c1c1c;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff5e3a;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff6c4a;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Secure Your Seat</h1>
        <form action="process_booking.php" method="post">

            <div class="form-group">
                <label for="theatre">Select Theatre:</label>
                <select id="theatre" name="theatre" required onchange="fetchMoviesAndTimeSlots()">
                    <option value="">Select Theatre</option>
                    <?php
                    $query = "SELECT * FROM `theatres`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - <?php echo $row['location']; ?></option>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
    <label for="movieTimeSlot">Select Movie and Time Slot:</label>
    <select id="movieTimeSlot" name="movieTimeSlot" required>
        <option value="">Select Movie and Time Slot</option>
        <!-- Movie options will be dynamically populated here using JavaScript -->
    </select>
</div>

<div class="form-group">
                <label for="Class">Select Class:</label>
                <select id="Class" name="Class" required>
                    <option value="">Select Class</option>
                    <?php
                    $query = "SELECT * FROM `classes`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> - <?php echo $row['price']; ?></option>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Error fetching data</td></tr>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tickets">Number of Tickets:</label>
                <input type="number" id="tickets" name="tickets" min="1" required>
            </div>
            <input name="book" type="submit" value="Book Now">
        </form>
    </div>

    <script>
function fetchMoviesAndTimeSlots() {
    var theatreId = document.getElementById('theatre').value;
    var movieTimeSlotDropdown = document.getElementById('movieTimeSlot');

    // Clear existing options
    movieTimeSlotDropdown.innerHTML = '<option value="">Select Movie, Theatre, and Time Slot</option>';

    if (theatreId !== '') {
        // Fetch movies, theatres, and associated time slots based on selected theatre using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Parse JSON response and populate movie, theatre, and time slot dropdown
                    var data = JSON.parse(xhr.responseText);

                    console.log('Data received:', data); // Log the received data

                    for (var i = 0; i < data.length; i++) {
                        var movieTimeSlotOption = document.createElement('option');
                        movieTimeSlotOption.value = data[i].slot_id; // You can use slot_id as the value
                        movieTimeSlotOption.textContent = data[i].movie_name + ' - ' + data[i].movie_category +
                            ' - ' + data[i].time_slot;
                        movieTimeSlotDropdown.appendChild(movieTimeSlotOption);
                    }
                } else {
                    console.error('Failed to fetch data. Status:', xhr.status);
                }
            }
        };

        xhr.open('GET', 'fetch_movies_and_time_slots.php?theatre_id=' + theatreId, true);
        xhr.send();
    }
}

// Ensure that the fetchMoviesAndTimeSlots() function is called when the theatre dropdown changes
document.getElementById('theatre').addEventListener('change', fetchMoviesAndTimeSlots);

</script>



</body>

</html>