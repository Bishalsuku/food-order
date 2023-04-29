<?php include("partials/menu.php") ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Category</h1>
        <br><br>

             <?php 
              if(isset($_SESSION['add'])) // checking whether the session is set or not
              {
               echo $_SESSION['add']; // displaying session message if set
               unset($_SESSION['add']); // removing session message
              }

              if(isset($_SESSION['upload'])) // checking whether the session is set or not
              {
               echo $_SESSION['upload']; // displaying session message if set
               unset($_SESSION['upload']); // removing session message
              }
              ?>
              <br><br>

        <form action="" method='POST' enctype="multipart/form-data" >
            <table class='tbl-30'>

                <tr>
                    <td>Title:</td>
                    <td><input type="text" name='title' placeholder="Category Title"></td>
                </tr>
                
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name='image' ></td>
                </tr>
                
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name='featured' value="Yes">Yes
                    <input type="radio" name='featured' value="No">No
                    </td>
                </tr>
                    
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name='active'  value="Yes">Yes
                    <input type="radio" name='active' value="No">No

                </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <input type="submit" name='submit' value='Add Category' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form> 

        <?php
        // check weather the submit button is clicked or not 
        if(isset($_POST['submit']))
        {
            // echo "clicked";
            //1. get the value from category form
            $title= $_POST['title'];
            
            //for radio input , we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form
                $featured= $_POST['featured'];
                
            }
            else{
                //set the default value
                $featured= "No";
            }

            if(isset($_POST['active']))
            {
                //get the value from form
                $active= $_POST['active'];
                
            }
            else{
                //set the default value
                $active= "No";
            }

            // check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            // die(); break //the code here

            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name , source path and destination path
                $image_name = $_FILES['image'];   
                
                //auto rename our image
                //get the extension of our image
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name= "food_category_".rand(000,999).'.'.$ext; //e.g food_category_34.jpg

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;
                
                //finally upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether image uploaded or not
                //if image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']= "<div class='error'> Failed to upload image.</div>";
                    //redirect to category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();

                }

            }
            else{
                //don't upload image and image_name value as blank
                $image_name="";
            }

            //2. create sql query to insert category into database
            $sql= "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //3. executing query and saving in database
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            //4. check whether the query is executed or not adn data added or not
            if($res==true)
            {
                //query executed and category added 
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                //redirect page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //failed to execute query and category not added
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                //redirect page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }

        ?>

    </div>

</div>

<?php include("partials/footer.php") ?>     