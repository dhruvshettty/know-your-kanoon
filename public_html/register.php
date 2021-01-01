<?php 
include_once '../resources/templates/header.php';
?>
    <div class="container-fluid p-5">
        <form class="text-center border border-light p-5" action="../resources/includes/register.inc.php" method="post">
            <p class="h4 mb-4 loginheading">Register</p>
            <div class="registerinputdiv" style="width: 35%;">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4 logininput" name="name" placeholder="Full name">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control mb-4 logininput" name="username" placeholder="User name">
                <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4 logininput" name="email" placeholder="E-mail">
                <input type="password" id="defaultRegisterFormPassword" class="form-control mb-4 logininput" name="pwd" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                <input type="password" id="defaultRegisterFormPassword" class="form-control mb-4 logininput" name="pwd_repeat" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
            </div>
            <button class="btn my-4 btn-block btn-primary" type="submit" name="submit">Sign Up</button>
        </form>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Fill in all feeds</p>";
            }
            else if ($_GET["error"] == "invalidusername"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Enter an appropriate username</p>";
            }
            else if ($_GET["error"] == "invalidemail"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Enter an a correct email</p>";
            }
            else if ($_GET["error"] == "pwdnomatch"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Re-entered password does not match</p>";
            }
            else if ($_GET["error"] == "usernametaken"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Username already taken</p>";
            }
            else if ($_GET["error"] == "stmtfailed"){
                echo "<p style='text-align: center;' class='alert alert-danger' role='alert'>Try again later</p>";
            }
            else if ($_GET["error"] == "none"){
                echo "<p style='text-align: center;' class='alert alert-success' role='alert' role='alert'>You have signed up</p>";
            }
        }
        ?>
    </div>

<?php 
include_once '../resources/templates/footer.php';
?>