<?php 
//if Click Submit and get request from the form
if(isset($_POST['submit'])){
    //Connect To Database
      include 'config.php';

    //fonction to sanatize data
     function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

 //Getting Data
    //email
        if(!empty($_POST['email_user'])){
            $email_user = test_input($_POST['email_user']);
            //$email_user = filter_var($email_user,FILTER_SANITIZE_EMAIL);
            $email_val = filter_var($email_user,FILTER_VALIDATE_EMAIL);
            $succ['email_user'] = $email_user;
            if(!$email_val){
                //header('LOCATION: registerPage.php?err=email_user_invalid');
                $err['email_user'] = 'invalide';
            }
        }else{
            //header('LOCATION: registerPage.php?err=email_user_empty');
            $err['email_user'] = 'empty';

        }    

    //Password
        if(!empty($_POST['password_user'])){
            $password_user = test_input($_POST['password_user']);
            $password_len = strlen($password_user);
            if($password_len<8){
                //header('LOCATION: registerPage.php?err=password_user_short');
                $err['password_user'] = 'short';
            }
        }else{
            //header('LOCATION: registerPage.php?err=password_user_empty');
            $err['password_user'] = 'empty';
        }


 //Errors Sender to register.php by GET method
        if(!empty($err)){
            $loc = '';
            
            foreach($err as $key => $value){
                if(!empty($value)){
                    $loc .= 'err_'. $key . '=' . $value .'&';
                }   
            }
            
            foreach($succ as $key => $value){

                $loc .= $key . '=' . $value .'&';

            }

            $loc = 'LOCATION: loginPage.php?'. $loc;
            header($loc);

            exit();
        }


       

 //SELECT DATA AND VERIFY IT FROM DATABASE
    //SQL Query/Request
        $sql = 'SELECT email_user,password_user FROM users WHERE email_user=:email_user and password_user=:password_user';
        
    //Prepare Statment
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email_user' => $email_user, 'password_user' => $password_user]);
    //Count Row To Verify
        $count = $stmt->rowCount();


        $loc='';
        foreach($succ as $key => $value){

            $loc .= $key . '=' . $value .'&';
        }

        if($count==1){
            //session_start();
            //$_SESSION['loggedUser'] = $email_user;
            $loc = 'LOCATION: loginPage.php?login=success&' . $loc;
            header($loc);
        }else{
            header('LOCATION: loginPage.php?err_email_password_wrong=');
        }
 
}else{
    header('LOCATION: loginPage.php'); 
}
    
?>