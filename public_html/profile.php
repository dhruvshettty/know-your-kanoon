<?php 
include_once '../resources/templates/header.php';
session_start();
?>

    <div class="heading">
    <!-- Default form register -->
    <p class="h1 mb-4 loginheading">Profile</p>
    <img class="profileimage" src="img/kanoon.png" alt="Lawyer Image">
<form class="text-center border border-light p-5" action="#!">
    <div class="registerinputdiv">
    <label>User ID</label>
    <input type="number" style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["id"] ?>' readonly>

    <div class="form-row mb-4">
        <div class="col">
            <!-- Last name -->
            <label>Full Name:</label>
            <input type="text" style="background-color: white" class="form-control logininput" value='<?php echo $_SESSION["name"] ?>'  readonly>
        </div>
        <div class="col">
            <!-- User name -->
            <label>Username:</label>
            <input type="text"  style="background-color: white" class="form-control logininput" value='<?php echo $_SESSION["username"] ?>' readonly>
        </div>
    </div>
  
    <!-- Email -->
    <label>Email ID:</label>
    <input type="email" style="background-color: white" class="form-control mb-4 logininput" value='<?php echo $_SESSION["email"] ?>' readonly>

    <!-- Joined on  -->
    <label>Joined On (yyyy-mm-dd hh:mm:ss):</label>
    <input type="text" style="background-color: white"  class="form-control logininput" value='<?php echo $_SESSION["joined_on"] ?>' aria-describedby="defaultRegisterFormPasswordHelpBlock" readonly>
    
    </div>



</form>
<!-- Default form register -->
    </div>

<?php
include_once '../resources/templates/footer.php';
?>