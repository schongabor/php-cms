<?php

	if(isset($_GET["update_user"])){
	
	  $user_id = $_GET["update_user"];
	  
	  $query = "SELECT * FROM users WHERE user_id = '{$user_id}' ";
	  $select_user_query = mysqli_query($connection, $query);
	  
	  while($row = mysqli_fetch_assoc($select_user_query)){
	  
	    $user_lastname = $row["user_lastname"];
	    $user_firstname = $row["user_firstname"];
	    $user_role = $row["user_role"];
	    $username = $row["username"];
	    $user_email = $row["user_email"];
	    $user_password = $row["user_password"];
	  
	  }
	  
	}

	if(isset($_POST["update_user"])){

		$user_lastname = $_POST["user_lastname"];
		$user_firstname = $_POST["user_firstname"];
		$user_role = $_POST["user_role"];
		$username = $_POST["username"];
		$user_email = $_POST["user_email"];
		$user_password = $_POST["user_password"];
		
		$query = "SELECT randSalt FROM users";
		$select_randSalt_query = mysqli_query($connection, $query);
		
		if(!$select_randSalt_query){
		
		  die("Query failed: ".mysqli_error($connection));
		
		}
		
		$row = mysqli_fetch_array($select_randSalt_query);
		$salt = $row["randSalt"];
		$hashed_password = crypt($user_password, $salt);
		
		$query  = "UPDATE users SET ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_role = '{$user_role}', ";
		$query .= "username = '{$username}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_password = '{$hashed_password}' ";
		$query .= "WHERE user_id = '{$user_id}' ";
		
		$update_user_query = mysqli_query($connection, $query);
		
		confirm_query($update_user_query);
	  }

?>

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
       <option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>

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
	  <input class="btn btn-primary" type="submit" name="update_user" value="Felhasználó módosítása">
  </div>


</form>




