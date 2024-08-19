
<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View List</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    

        <div class="container mt-5">

            <div class="row">
                <div class="col-lg-8">
                    <h1>View Grocery List</h1>
                    <a href="add.php"><button type="button" class="btn btn-primary">Add Item</button></a>
                    <!-- <a href="add.php">Add Item</a> -->
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-8">
                          
                            <form method="post" action="">
                              <input type="date" class="form-control" name="idate">
                        </div>
                          <div class="col-lg-4" method="post">
                            <input type="submit" class="btn btn-danger float-right" name="btn" value="filter">
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
            <?php
              include("connect.php");

             if (isset($_POST['btn']))
             {
                $date=$_POST['idate'];
                $q="select * from grocerytb where Date='$date'";
                $query=mysqli_query($con,$q);
              } 
	          else 
	           {
               $q= "select * from grocerytb";
               $query=mysqli_query($con,$q);
             }
            ?>
                
             <?php
                  while ($qq=mysqli_fetch_array($query)) 
                  {
                  
             ?>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $qq['item_name']; ?></h5>
                          <td><img src="<?php echo $qq['image']; ?>" height="100px" alt="grocery image"></td>
                          <h6 class="card-subtitle mb-2 text-muted"><?php echo $qq['item_Quantity']; ?></h6>
                          <?php
                          if($qq['item_status'] == 0) {
                          ?>
                            <p class="text-info">PENDING</p>
                          <?php
                          } else if($qq['item_status'] == 1) {
                          ?>
                            <p class="text-success">BOUGHT</p>
                          <?php } else { ?> 
                            <p class="text-danger">NOT AVAILABLE</p>
                          <?php } ?>
                         
                          <a href="delete.php?id=<?php echo $qq['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                          <a href="update.php?id=<?php echo $qq['id']; ?>"> <button type="button" class="btn btn-success">Update</button></a>
    					           
                        </div>

                      </div><br>
                </div>
                <?php
                  

                  }
                ?>
                 
                
            </div>
            <a href="logout.php"  class="btn btn-info">Logout</a>
        </div>
       
    </body>
</html>
