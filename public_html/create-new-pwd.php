<?php 
include_once '../resources/templates/header.php';
?>

    <div class="container">
        <?php
        $selector = $_GET["selector"];
        $validator =  $_GET["validator"];

        if (empty($selector) || empty($validator)) {
            echo "<p>We could not validate your request</p>";
        }
        else {
            if (ctype_xdigit($selector) === true && ctype_xdigit($validator) === true) { // check if params are in HEX format
                ?>
                <form action="../resources/includes/reset-pwd.inc.php" method="post">
                    <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                    <input type="password" name="pwd" placeholder="Enter a new password...">
                    <input type="password" name="pwd_repeat" placeholder="Reconfirm your password...">
                    <button type="submit" name="reset_pwd_submit">Reset password</button>
                </form>
                <?php
            }
        }
        ?>
    </div>
    

<?php
include_once '../resources/templates/footer.php';
?>