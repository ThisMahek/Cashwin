<?php
    try{
        $dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
    	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $name = ($_POST["email"]);
        $userpassword=($_POST['password']);
        $stmt=$dbh->query("select count(*) as usern from user_profile where email='$name'");
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($results[0]["usern"]=="0")
            $status=3;
        else {
            $stmt=$dbh->query("SELECT email,password FROM user_profile where email='$name'");
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if($results[0]["password"]==$userpassword) {
                if($results[0]["login_status"]==0) {
                    $status=1;
                    $q1="update user_profile set login_status='1' where email='$email'";
                    $dbh->exec($q1);
                } else
                    $status=4;
            } else
                $status=2;
        }
        echo json_encode($status);
    } catch(PDOException $e) {
    	echo "Connection failed:".$e->getMessage();
    }
?>
