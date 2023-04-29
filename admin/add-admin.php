<?php include("partials/menu.php") ?>


<div class="main-content">
    <div class='wrapper'>
        <h1>Add Admin</h1>
        <br><br>

             <?php 
              if(isset($_SESSION['add'])) // checking whether the session is set or not
              {
               echo $_SESSION['add']; // displaying session message if set
               unset($_SESSION['add']); // removing session message
              }
              ?>
              <br><br>


        <form action="" method='POST' >
            <table class='tbl-30'>

                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name='full_name' placeholder="Enter your name"></td>
                </tr>
                
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name='username' placeholder="Enter your username"></td>
                </tr>
                    
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name='password' placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="submit" name='submit' value='Add Admin' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form> 
    </div>
</div>

<?php include("partials/footer.php") ?>    


<?php
//Process the value from form and save it into database
// check weather the submit button is clicked or not 
if(isset($_POST['submit']))
{
    //1. get the data form form 
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with md5

   //2. sql Query to save the data into database 
    $sql= "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    
   
    //3. executing query and saving in database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    //4. check whether the (query is executed) data is inserted or not and display appropriate message
    if($res)
    {
        // echo" data inserted";
        // create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //redirect page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // echo" data not inserted";
         // create a session variable to display message
         $_SESSION['add'] = "Fail to Add Admin";
         //redirect page
         header('location:'.SITEURL.'admin/add-admin.php');
    }

}
?>