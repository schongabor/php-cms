<?php require_once("includes/admin_header.php"); ?>
<?php

if(isset($_SESSION["username"])){

	$username = $_SESSION["username"];

	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	$select_user_profile_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_array($select_user_profile_query)){
		
		$user_id = $row["user_id"];
		$username = $row["username"];
		$user_firstname = $row["user_firstname"];
		$user_lastname = $row["user_lastname"];
		$user_role = $row["user_role"];
		$user_email = $row["user_email"];
		$user_password = $row["user_password"];	
		
	}
	
}

if(isset($_POST["update_profile"])){

	$username = $_POST["username"];
	$user_firstname = $_POST["user_firstname"];
	$user_lastname = $_POST["user_lastname"];
	$user_role = $_POST["user_role"];
	$user_email = $_POST["user_email"];
	$user_password = $_POST["user_password"];	

	$query  = "UPDATE users SET ";
	$query .= "user_firstname = '{$user_firstname}', ";
	$query .= "user_lastname = '{$user_lastname}', ";
	$query .= "user_role = '{$user_role}', ";
	$query .= "user_email = '{$user_email}', ";
	$query .= "user_password = '{$user_password}' ";
	$query .= "WHERE user_id = '{$username}' ";

	$update_profile_query = mysqli_query($connection, $query);
	confirm_query($update_profile_query);

}



?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<h1 class="page-header">
                            Üdv az admin oldalon
                            <small><?php echo $username; ?></small>
                        </h1>
					<form action="" method="post" enctype="multipart/form-data">    
  
						  <div class="form-group">
							 <label for="user_lastname">Vezetéknév</label>
							  <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
						  </div>
						  
						  <div class="form-group">
							 <label for="user_firstname">Keresztnév</label>
							  <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
						  </div>

						 <div class="form-group">
							 <select name="user_role" id="user_role">
							   <option value='Felíratkozó'><?php echo $user_role ?></option>

							<?php
							  if($user_role == 'Adminisztrátor'){
								echo "<option value='Felíratkozó'>Feliratkozó</option>";
							  } else {
								echo "<option value='Adminisztrátor'>Adminisztrátor</option>";	    
							  }
							?>
							 </select>
						  </div>
						  
						  <div class="form-group">
							 <label for="username">Felhasználónév</label>
							  <input value="<?php echo $username;?>" type="text" class="form-control" name="username">
						  </div>

						  <div class="form-group">
							 <label for="user_email">Email</label>
							  <input value="<?php echo $user_email;?>" type="email" class="form-control" name="user_email">
						  </div>


						  <div class="form-group">
							 <label for="user_password">Jelszó</label>
							  <input value="<?php echo $user_password;?>" type="password" class="form-control" name="user_password">
						  </div>
						<!--div class="form-group">
							 <label for="user_image">Kép</label>
							  <input type="file"  name="image">
						  </div-->


						   <div class="form-group">
							  <input class="btn btn-primary" type="submit" name="update_profile" value="Profil frissítése">
						  </div>


					</form>
					
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
<?php require_once("includes/admin_footer.php"); ?>
  
