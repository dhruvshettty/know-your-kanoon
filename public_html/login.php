<?php 
include_once '../resources/templates/header.php';
?>

    <div class="container">
        <form class="text-center border border-light p-5" action="../resources/includes/login.inc.php" method="post">
            <p class="h4 mb-4 loginheading">Sign In</p>
            <div class="registerinputdiv">
                <input type="text" id="defaultRegisterFormFirstName" class="form-control logininput" name="username" placeholder="Username / Email">
                <input type="password" id="defaultRegisterFormPassword" class="form-control logininput" name="pwd" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
            </div>
            <button class="btn my-4 btn-block loginbutton" type="submit" name="submit">Sign In</button>
        </form>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all feeds</p>";
            }
            else if ($_GET["error"] == "wronglogin"){
                echo "<p>Incorrect login credentials</p>";
            }
        }
        ?>
    </div>

<?php
include_once '../resources/templates/footer.php';
?>