<?php

if(isset($_SESSION['auth']))
{
    if(isset($_SESSION['loggedInUserRole']))
    {
        $role = validate($_SESSION['loggedInUserRole']);
        $email = validate($_SESSION['loggedInUser']['email']);

        $query = "SELECT * FROM users WHERE email='$email' AND role='$role' LIMIT 1";
        $result = mysqli_query($conn,$query);
        
        if($result)
        {
            if(mysqli_num_rows($result) == 0)
            {
                logoutSession();
                redirect('../loginform.php','Acess Denied');
            }
            else{
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                if($row['role'] != 'admin'){
                logoutSession();
                redirect('../loginform.php','Acess Denied');
                } 
            }
        }else
        {
            logoutSession();
            redirect('../loginform.php','Something Went Wrong');
        }
    }
}else{
    redirect('../loginform.php','Login to continue....');
}

?>