<?php
include("header.php");

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {

    if (isset($_GET['id'])) {
        $ed = $_GET['id'];
        $update = mysqli_query($con, "SELECT * FROM `slots` WHERE id=$ed");
        $row = mysqli_fetch_assoc($update);
    }?>
<div class="container-fluid pt-4 px-4">
                <div class="row ">
                <div class="col">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Update Slot</h6>
<form onsubmit="return validation()" method="post" action="" >
                            <div class="form-floating mb-3">
                                <input value="<?php echo $row['slot'] ?>" id="input" name="input" type="text" class="form-control" id="floatingInput"
                                    placeholder="name@example.com"><span id="error"></span>
                                <label for="floatingInput">Time</label>
                            </div>
                        
                            <div class="m-n2">
                                <button name="add" type="submit" class="btn btn-outline-primary m-2">Update Slot</button></div>
                        </div>
                        </form>

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

    $query = "UPDATE `slots` SET `slot`='$timeSlot' WHERE id=$ed";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<script>alert('Slot updated successfully.');</script>";
        echo "<script>location.assign('time_slots.php')</script>";
    } }
?>

<?php
}include("footer.php");

?>