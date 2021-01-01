<?php 
include_once '../resources/templates/header.php';
?>

    <div class="container-fluid p-5">
        <form class="text-center border border-light p-5" action="../resources/includes/login.inc.php" method="post">
            <p class="h4 mb-4 loginheading">Sign In</p>
            <div class="registerinputdiv" style="width: 35%;">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control logininput mb-2" name="username" placeholder="Username / Email">
                <input type="password" id="defaultRegisterFormPassword" class="form-control logininput" name="pwd" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
            </div>
            <button class="btn my-4 btn-primary" type="submit" name="submit">Sign In</button> <br>
            <a href="reset.php">Forgot your password?</a>
        </form>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Fill in all feeds</p>";
            }
            else if ($_GET["error"] == "wronglogin"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Incorrect login credentials</p>";
            }
        }

        if (isset($_GET["newpwd"])) {
            if ($_GET["newpwd"] == "updated") {
                echo "<p>Your password has been reset!</p>";
            }
        }
        ?>
    </div>

<?php
include_once '../resources/templates/footer.php';
?>