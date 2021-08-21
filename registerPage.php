<!DOCTYPE html>
<html>
    <head>
        <title>Register Page</title>
        <meta lang="">
        <meta charset="UTF-8">
        <meta name="" content="" >
        <meta name="" content="" >
        <meta name="" content="" >
        <link rel="stylesheet" href="" type="text/css">

    </head>

    <body>
        <form action="<?php $action='register.php'; echo htmlspecialchars($action);  ?>" method="post">
            <p>Nom <span style="color:red;">*<?php if(isset($_GET['err_nom_user'])){switch($_GET['err_nom_user']){
                case 'empty': echo 'Nom require'; break;
                case 'invalid': echo 'You entred invalid nom'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="Nom" name="nom_user" style="display: block;"<?php  if(isset($_GET['nom_user'])) echo 'value="'.$_GET['nom_user'].'"';?>>
            
            <p>Prenom <span style="color:red;">*<?php if(isset($_GET['err_prenom_user'])){switch($_GET['err_prenom_user']){
                case 'empty': echo 'Prenom require'; break;
                case 'invalid': echo 'You entred invalid prenom'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="Prenom" name="prenom_user" style="display: block;"<?php  if(isset($_GET['prenom_user'])) echo 'value="'.$_GET['prenom_user'].'"';?>> 
            
            <p>Groupage <span style="color:red;">*<?php if(isset($_GET['err_groupage']))echo 'Groupage require'?></span></p>
            <select name="groupage" style="display: block;">
                <option value="" disabled <?php if(!isset($_GET['groupage'])) echo 'selected';?>>Groupage</option>
                <option value="O-"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='O-') echo 'selected';?>>O-</option>
                <option value="O+"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='O+') echo 'selected';?>>O+</option>
                <option value="A-"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='A-') echo 'selected';?>>A-</option>
                <option value="A+"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='A+') echo 'selected';?>>A+</option>
                <option value="B-"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='B-') echo 'selected';?>>B-</option>
                <option value="B+"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='B+') echo 'selected';?>>B+</option>
                <option value="AB-"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='AB-') echo 'selected';?>>AB-</option>
                <option value="AB+"<?php if(isset($_GET['groupage']) && $_GET['groupage']=='AB+') echo 'selected';?>>AB+</option>
            </select>
            
            <p>Email <span style="color:red;">*<?php if(isset($_GET['err_email_user'])){switch($_GET['err_email_user']){
                case 'empty': echo 'email require'; break;
                case 'invalid': echo 'You entred invalid email'; break;
                case 'already_existe': echo 'Email is already existe'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="email" name="email_user" style="display: block;"<?php  if(isset($_GET['email_user'])) echo 'value="'.$_GET['email_user'].'"';?>> 
            
            <p>Password <span style="color:red;">*<?php if(isset($_GET['err_password_user'])){switch($_GET['err_password_user']){
                case 'empty': echo 'password require'; break;
                case 'short': echo 'You entred short password'; break;
                default: break;
            }} ?></span></p>
            <input type="password" placeholder="password" name="password_user" style="display: block;">

            <p>Date Naissance <span style="color:red;">*<?php if(isset($_GET['err_date_naissance']))echo 'Date naissance require'?></span></p>
            <input type="date"<?php if(isset($_GET['date_naissance'])) echo 'value="'.$_GET['date_naissance'].'"';?> name="date_naissance" style="display: block;">
            
            <p>Number Phone <span style="color:red;">*<?php if(isset($_GET['err_phone'])){switch($_GET['err_phone']){
                case 'empty': echo 'phone require'; break;
                case 'invalid': echo 'You entred invalid phone number'; break;
                default: break;
            }} ?></span></p>
            <input type="text" placeholder="phone" name="phone" style="display: block;"<?php  if(isset($_GET['phone'])) echo 'value="'.$_GET['phone'].'"';?>> 
            <input type="submit" name="submit" value="SignUp">
        </form>

        <?php
            if(isset($_GET['signup']) && $_GET['signup']=='success'){
                echo '<p>success signup, wait to go to login page</p>';
                //sleep(5);
                //header('LOCATION: loginPage.php?email_user='.$_GET['email_user']);
            } 
        
        ?>
    </body>
</html>