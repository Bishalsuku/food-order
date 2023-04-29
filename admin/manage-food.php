<?php include("partials/menu.php") ?>
<!-- Main Content Section starts -->
<div class="main-content">
            <div class="wrapper">
              <h1>Manage food</h1>
              <br><br><br>
              <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
              <br><br>

              <?php 
                if(isset($_SESSION['add'])) // checking whether the session is set or not
                {
                echo $_SESSION['add']; // displaying session message if set
                unset($_SESSION['add']); // removing session message
                }
            ?>
        <br><br>

              <table class="tbl-full">
                <tr>
                  <th>S.N</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Featured</th>
                  <th>Active</th>
                  <th>Actions</th>
                </tr>

                <?php
                $sql= "SELECT*FROM tbl_food";

                $res = mysqli_query($conn,$sql);

                $count =mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                      $id=$row['id'];
                      $title=$row['title'];
                      $price=$row['price'];
                      $image_name=$row['image_name'];
                      $featured=$row['featured'];
                      $active=$row['active'];

                      ?>

                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo $title; ?></td>
                          <td>$<?php echo $price; ?></td>
                          <td>
                            <?php 
                            if($image_name=="")
                            {
                              echo "<div class='error'>Image not added.</div>";
                            }
                            else{
                              ?>
                              <img src ="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" width=100px>
                              <?php
                            }
                            ?>
                          </td>
                          <td><?php echo $featured; ?></td>
                          <td><?php echo $active; ?></td>
                          <td>
                            <a href="#" class="btn-secondary">Update Food</a>
                            <a href="#" class="btn-danger">Delete Food</a>
                          </td>
                        </tr>
                      
                      <?php
                    }
                }
                else{
                  echo "<tr><td colspan='7' class='error'>Food not found yet.</td></tr>";
                }
                ?>
                
              
                

              </table>
            </div>
        </div>
        <!-- Main Content Section ends -->
<?php include("partials/footer.php") ?>     