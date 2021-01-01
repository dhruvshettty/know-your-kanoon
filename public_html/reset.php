<?php 
include_once '../resources/templates/header.php';
?>

    <div class="container p-5">
        <div class="row">
            <div class="alert alert-info p-4 mt-5" role="alert">
            <h4 class="alert-heading">Forgotten your password?</h4>
            <p>Aww that sucks, but no worries. We'll send you a recovery link on your registered email.</p>
            <hr>
            <p class="mb-0">Just enter your email in the form below for your recovey link.</p>
            </div>
        </div>
        <div class="row">
            <form class="text-center border border-light p-5" action="../resources/includes/reset.inc.php" method="post">
                <p class="h4 mb-4 loginheading">Sign In</p>
                <div class="registerinputdiv">
                    <input type="text" id="defaultRegisterFormEmail" class="form-control logininput" name="email" placeholder="Enter your email address">
                </div>
                <button class="btn my-4 btn-dark loginbutton" type="submit" name="reset">Send recovery link.</button>
            </form>
        </div>
        <?php
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo "<p>Password recovery link sent successfully!</p>";
            }
            else {
                echo "<p>Something went wrong.</p>";
            }
        }
        ?>
    </div>
    

<?php
include_once '../resources/templates/footer.php';
?>