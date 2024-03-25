<?php
include("header.php");

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
?>

<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Slot</h6>
                            <form onsubmit="return validation()" method="post" action="" >
                            <div class="form-floating mb-3">
                                <input id="input" name="input" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com"><span id="error"></span>
                                <label for="floatingInput">Time</label>
                            </div>
                        
                            <div class="m-n2">
                                <button name="add" type="submit" class="btn btn-outline-primary m-2">Add Theatre</button></div>
                        </div>
                        </form>
                    </div>
                    <script>
function validation() {
    var t = document.getElementById('input').value;
    const timeRegex = /^(1[0-2]|0?[1-9]):[0-5][0-9] (am|pm) - (1[0-2]|0?[1-9]):[0-5][0-9] (am|pm)$/;

    if (timeRegex.test(t)) {
        document.getElementById('error').innerHTML = "";
        return true; // Allow form submission
    } else {
        document.getElementById('error').innerHTML = "Invalid format";
        return false; // Prevent form submission
    }
}
</script>


<?php

if(isset($_POST['add'])) {
    $timeSlot = $_POST['input'];

    $query = "INSERT INTO `slots`(`slot`) VALUES ('$timeSlot')";
    $result = mysqli_query($con, $query);}
?>


                    
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Time slots</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Slots</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    $query = "SELECT * FROM `slots`";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                        <td><?php echo $row['slot']; ?></td>
                                        <td><a href="edit slot.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-success m-2">Update</a></td>
                                        <td><a href="time_slots.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-danger m-2">Delete</a></td>
                                    </tr>
                                    
                                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>Error fetching data</td></tr>";
                    }?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
if (isset($_GET['id'])) {
    $del = $_GET['id'];
    $check = mysqli_query($con, "DELETE FROM `slots` WHERE id=$del");
    if ($check) {
        echo "<script>location.assign('time_slots.php')</script>";
    }
}

?>
<?php
}
else{ ?>
    <div class="text-center">
        <p>You must be logged in to access the admin panel.</p>
        <a href="signin.php" class="btn btn-outline-warning w-50 m-2" type="button">Log In</a>
    </div>
<?php
}
include("footer.php");
?>