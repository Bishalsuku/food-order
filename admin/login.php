<?php include("../config/constants.php") ?>



<html>
    <head>
        <title>
            Login - Food Order System
        </title>
        <link rel='stylesheet' href='../css/admin.css' >
    </head>

    <body>
        <div class='login'>
            <h1 class='text-center'>Login</h1><br><br>

            <?php
            if(isset($_SESSION['login']))
            {
             echo $_SESSION['login']; // displaying session message
             unset($_SESSION['login']); // removing session message
            }

            if(isset($_SESSION['no-login-message']))
            {
             echo $_SESSION['no-login-message']; // displaying session message
             unset($_SESSION['no-login-message']); // removing session message
            }
            
            ?>
            <br><br>

            <form action="" method='POST' class='text-center'>
                Username: <br>
                <input type="text" name='username' placeholder='Enter Username'><br><br>
                Password:<br>
                <input type="password" name='password' placeholder='Enter Password'><br><br>

                <input type="submit" name='submit' value='Login' class="btn-primary"><br><br>

            </form>
            
            <p class="text-center">Created By - <a href="www.BishalSukubhatu.com">Bishal Sukubhatu</a></p>
        </div>
    </body>
</html>

<?php
 //check whether the submit button is clicked or not
 if(isset($_POST['submit']))
 {
    //process for login
    //1. get the data from login
    $username =$_POST['username'];
    $password =md5($_POST['password']);

    //2. sql to check whether the user with username and password exists or not
    $sql = "SELECT*FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. execute the query
    $res = mysqli_query($conn, $sql);

    //4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user available AND LOGIN SUCCESS
        $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
         //redirect page
         header('location:'.SITEURL.'admin/');
    
    }
    else{
        //user not available and login failed
        $_SESSION['login'] = "<div class='error text-center'>Username or Password Didn't Matched.</div>";
        //redirect page
        header('location:'.SITEURL.'admin/login.php');
   
    }
 }


?>