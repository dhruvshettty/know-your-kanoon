<?php 
include_once '../resources/templates/header.php';
session_start();
?>

    <div class="container p-5">
        <div class="row">
            <p class="h1 mb-4 loginheading">Profile</p>
            <img class="profileimage" src="img/kanoon.png" alt="Lawyer Image">
        </div>
        <div class="row">
            <label>User ID</label>
            <input type="number" style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["id"] ?>' readonly>
        </div>
        <div class="row">
            <label>Full Name:</label>
            <input type="text" style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["name"] ?>'  readonly>
        </div>
        <div class="row">
            <label>Username:</label>
            <input type="text"  style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["username"] ?>' readonly>
        </div>
        <div class="row">
            <label>Email ID:</label>
            <input type="email" style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["email"] ?>' readonly>
        </div>
        <div class="row">
            <label>Joined On (yyyy-mm-dd hh:mm:ss):</label>
            <input type="text" style="background-color: white"  class="form-control logininput" value='<?php echo $_SESSION["joined_on"] ?>' aria-describedby="defaultRegisterFormPasswordHelpBlock" readonly>
        </div>
    </div>

<?php
include_once '../resources/templates/footer.php';
?>