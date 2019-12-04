<img src="img/loggain.png" alt="Logga in för att få administrationsbehörigheter">
<div class="articleDiv">
    <div class="articleDiv2">
        <form method="POST" action="incl/login-process.php">
            <fieldset id="fieldAdmin">
                <legend>Login <img id="loginIco" src="img/login.ico"></legend><br>
                <input id="adminForm" type="text" placeholder="Namn" name="username" value="<?php echo $username;?>"><br><br>
                <input id="adminForm" type="password" placeholder="Lösenord" maxlength="15" name="password" value="<?php echo $password;?>"><br><br>
                <input id="adminSub" type="submit" name="Submit" value="Login">
                <span class="error"><?php echo "<br>".$passwordErr;?></span>
            </fieldset>
        </form>
    </div>
    <div class="articleDiv3">
        <img id="print" src="img/print2.png" alt="">
    </div>
</div>
