<?php include("partials/menu.php") ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method='POST'>
            <table class=tbl-30>
                    <tr>
                        <td> Current Password:</td>
                        <td><input type="password" name='current-password' placeholder='Current Password'></td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name='new-password' placeholder='New Password'></td>
                    </tr>
                    
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name='confirm-password' placeholder='Confirm Password'></td>
                    </tr>

                    <tr>
                        <td colspan='2'>
                        <input type="hidden" name='id' value='<?php echo $id; ?>' >
                        <input type="submit" name='submit' value='Update password' class='btn-secondary'>
                        </td>
                    </tr>

                </table>

        </form>

    </div>

</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo 'Button Clicked';
        //1. get the data from form
         $id =$_POST['id'];
         $current_password =md5($_POST['current-password']);
         $new_password =md5($_POST['new-password']);
         $confirm_password =md5($_POST['confirm-password']);

        //2. check whether the user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // -- execute the query
        $res = mysqli_query($conn, $sql);
        
        if($res==TRUE)
        {
            // -- check whether data is available or not
            $count =mysqli_num_rows($res);

            if($count==1)
            {
                // -- user exists and password can be changed
                // echo "User Found";
                // check whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2 = "UPDATE tbl_admin SET
                    password= '$new_password'
                    WHERE id=$id
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not
                    if($res2==true)
                    {
                        //display success message
                         //redirect to manage admin page with success message
                        $_SESSION['change-psw'] = "<div class='success'>Passord Changed Successfully.</div>";
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //display error message
                         //redirect to manage admin page with errormessage
                        $_SESSION['change-psw'] = "<div class='error'>Failed To Change Password.</div>";
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                }
                else
                {
                    //redirect to manage admin page with errormessage
                    $_SESSION['psw-not-match'] = "<div class='error'>Passord Didn't Match.</div>";
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            } 
            else
            {
                // -- //user doesnot exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
                
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }
        else
        {

            //  change password if all above is true
        }

       

    } 

?>


<?php include("partials/footer.php") ?>
