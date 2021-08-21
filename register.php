
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

   //Error Handling
        $err = [];
   //Success Get array
        $succ = [];

    //Getting Data From Form
       //nom
        if(!empty($_POST['nom_user'])){
            $nom_user = test_input($_POST['nom_user']);
            $nom_user = ucfirst($nom_user);
            $nom_val = preg_match("/^[a-zA-Z]*$/",$nom_user);
            $succ['nom_user'] = $nom_user;
            if(!$nom_val){
                //header('LOCATION: registerPage.php?err=nom_user_invalid');
                $err['nom_user'] = 'invalid';
            }
        }else{
            //header('LOCATION: registerPage.php?err=nom_user_empty');
            $err['nom_user'] = 'empty';
        }

       //Prenom
        if(!empty($_POST['prenom_user'])){
            $prenom_user = test_input($_POST['prenom_user']);
            $prenom_user = ucfirst($prenom_user);
            $prenom_val = preg_match("/^[a-zA-Z]*$/",$prenom_user);
            $succ['prenom_user'] = $prenom_user;
            if(!$prenom_val){
                //header('LOCATION: registerPage.php?err=prenom_user_invalid');
                $err['prenom_user'] = 'invalid';
            } 
        }else{
            //header('LOCATION: registerPage.php?err=prenom_user_empty');
            $err['prenom_user'] = 'empty';

        }

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
           //Verify if there's one email or not
            $sql = 'SELECT email_user FROM users';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $emails = $stmt->fetchall(PDO::FETCH_COLUMN);
            if(in_array($email_user,$emails)){
                //header('LOCATION: registerPage.php?err=email_user_already_existe');
                $err['email_user'] = 'already_existe';
            }
            
        }else{
            //header('LOCATION: registerPage.php?err=email_user_empty');
            $err['email_user'] = 'empty';

        }

       //date_naissance
        if(!empty($_POST['date_naissance'])){
            $date_naissance = $_POST['date_naissance'];
            $succ['date_naissance'] = $date_naissance;
        }else{
            //header('LOCATION: registerPage.php?err=date_naissance_empty');
            $err['date_naissance'] = 'empty';
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

       //phone
        if(!empty($_POST['phone'])){
            $phone = test_input($_POST['phone']);
            $phone_val = preg_match("/^[0-9\+]*$/",$phone);
            $phone_len = strlen($phone);
            $succ['phone'] = $phone;
            if(!$phone_val || $phone_len<10){
                //header('LOCATION: registerPage.php?err=phone_invalid');
                $err['phone'] = 'invalid';
            }
        }else{
            //header('LOCATION: registerPage.php?err=phone_empty');
            $err['phone'] = 'empty';

        }

       //groupage
        if(!empty($_POST['groupage'])){
            $groupage = $_POST['groupage'];
            $succ['groupage'] = $groupage;
        }else{
            //header('LOCATION: registerPage.php?err=groupage_empty');
            $err['groupage'] = 'empty';
        }

    //Errors Sender to register.php by GET method
        if(!empty($err)){
            $loc = '';
           
            foreach($err as $key => $value){
                if(!empty($value)){
                    $loc .= 'err_'. $key . '=' . $value .'&';
                }   
            }

           //To Keep Data in the Fields
            foreach($succ as $key => $value){

                $loc .= $key . '=' . $value .'&';

            }

            $loc = 'LOCATION: registerPage.php?'. $loc;
            header($loc);

            exit();
        }

        $loc='';

    //Inserting Data Into Database
       //SQL Query-Request
        $sql = 'INSERT INTO users (nom_user, prenom_user, date_naissance, phone, groupage, password_user, email_user) 
                VALUES (:nom_user, :prenom_user, :date_naissance, :phone, :groupage, :password_user, :email_user)'; 
       //Prepare Statment
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom_user' => $nom_user, 'prenom_user' => $prenom_user,'date_naissance' => $date_naissance,
        'phone' => $phone, 'groupage' => $groupage, 'password_user' => $password_user, 'email_user' => $email_user]);
       //To Keep Data in the Fields
        foreach($succ as $key => $value){

                $loc .= $key . '=' . $value .'&';
        }

        $loc = 'LOCATION: registerPage.php?signup=success&' . $loc;
        header($loc);

}else{
    header('LOCATION: registerPage.php'); 
}

?>