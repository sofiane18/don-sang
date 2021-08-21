<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
    </head>

    <body>
    <?php if(isset($_GET['err_email_password_wrong'])) echo '<p style="color:red;">Email or password is wrong</p>';?>
    <form action="<?php $action='login.php'; echo htmlspecialchars($action);  ?>" method="post">
            <p>Email <span style="color:red;"><?php if(isset($_GET['err_email_user'])){switch($_GET['err_email_user']){
                case 'empty': echo 'email require'; break;
                case 'invalid': echo 'You entred invalid email'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="Email" name="email_user" style="display: block;"<?php  if(isset($_GET['email_user'])) echo 'value="'.$_GET['email_user'].'"';?>>
            <p>Password <span style="color:red;"><?php if(isset($_GET['err_password_user'])){switch($_GET['err_password_user']){
                case 'empty': echo 'password require'; break;
                case 'short': echo 'You entred short password'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="Password" name="password_user" style="display: block;"<?php  if(isset($_GET['password_user'])) echo 'value="'.$_GET['password_user'].'"';?>> 
            <input type="submit" name="submit" value="Login">
    </form>
    <?php
            if(isset($_GET['login']) && $_GET['login']=='success'){
                echo '<p>success login, wait to go to profile page</p>';
                //sleep(5);
                //header('LOCATION: loginPage.php?email_user='.$_GET['email_user']);
            } 
        
        ?>

    </body> 

</html>