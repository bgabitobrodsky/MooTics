<?php if(isset($_SESSION["message"])){?>
    <div class="notification-box" id="notification-box">
        <div id="notification" class="alert alert-dismissible fade in show alert-<?php echo $_SESSION["message-type"];?>" role="alert">
            <?php echo $_SESSION["message"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php unset($_SESSION["message"]); } ?>