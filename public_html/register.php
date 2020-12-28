<?php 
include_once '../resources/templates/header.php';
?>
    <div class="container">
        <form class="text-center border border-light p-5" action="includes/register.inc.php" method="post">
            <p class="h4 mb-4 loginheading">Sign In</p>
            <div class="registerinputdiv">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control logininput" name="name" placeholder="Full name">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control logininput" name="username" placeholder="User name">
                <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4 logininput" name="email" placeholder="E-mail">
                <input type="password" id="defaultRegisterFormPassword" class="form-control logininput" name="pwd" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                <input type="password" id="defaultRegisterFormPassword" class="form-control logininput" name="pwd_repeat" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
            </div>
            <button class="btn my-4 btn-block loginbutton" type="submit" name="submit">Sign Up</button>
        </form>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all feeds</p>";
            }
            else if ($_GET["error"] == "invalidusername"){
                echo "<p>Enter an appropriate username</p>";
            }
            else if ($_GET["error"] == "invalidemail"){
                echo "<p>Enter an a correct email</p>";
            }
            else if ($_GET["error"] == "pwdnomatch"){
                echo "<p>Re-entered password does not match</p>";
            }
            else if ($_GET["error"] == "usernametaken"){
                echo "<p>Username already taken</p>";
            }
            else if ($_GET["error"] == "stmtfailed"){
                echo "<p>Try again later</p>";
            }
            else if ($_GET["error"] == "none"){
                echo "<p>You have signed up</p>";
            }
        }
        ?>
    </div>

<?php 
include_once '../resources/templates/footer.php';
?>