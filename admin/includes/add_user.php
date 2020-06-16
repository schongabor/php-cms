<?php

	if(isset($_POST["add_user"])){

		$user_lastname = $_POST["user_lastname"];
		$user_firstname = $_POST["user_firstname"];
		$user_role = $_POST["user_role"];
		$user_email = $_POST["user_email"];
		$user_image = "nulla";
		$randSalt = "0000";
		//$user_image = $_FILES["image"]["name"];
		//$user_image_temp = $_FILES["image"]["tmp_name"];
		
		$username = $_POST["username"];
		$user_password = $_POST["user_password"];
		//$user_date = date("y-m-d");
		
		//move_uploaded_file($user_image_temp, "../images/$user_image");
		
		$query = "INSERT INTO users(user_lastname, user_firstname, 
		user_role, user_email, username, user_password, user_image, 
		randSalt) 
		VALUES('{$user_lastname}', 
		'{$user_firstname}', '{$user_role}', '{$user_email}', 
		'{$username}', '{$user_password}', '{$user_image}', '{$randSalt}' )";
		
		$add_user_query = mysqli_query($connection, $query); 
		
		confirm_query($add_user_query);
		
		echo "Felhasználó hozzáadva: " . " " . "<a href='users.php'>Összes felhasználó megtekintése</a>";


	}

?>
<form action="" method="post" enctype="multipart/form-data">    
  
  <div class="form-group">
	 <label for="user_lastname">Vezetéknév</label>
	  <input type="text" class="form-control" name="user_lastname">
  </div>
  
  <div class="form-group">
	 <label for="user_firstname">Keresztnév</label>
	  <input type="text" class="form-control" name="user_firstname">
  </div>

 <div class="form-group">
     <select name="user_role" id="user_role">
        <option value='Felíratkozó'>Választási lehetőségek</option>";
	<option value='Felíratkozó'>Feliratkozó</option>";
	<option value='Adminisztrátor'>Adminisztrátor</option>";
     </select>
  </div>
  
  <div class="form-group">
	 <label for="username">Felhasználónév</label>
	  <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
	 <label for="user_email">Email</label>
	  <input type="text" class="form-control" name="user_email">
  </div>


  <div class="form-group">
	 <label for="user_password">Jelszó</label>
	  <input type="password" class="form-control" name="user_password">
  </div>
<!--div class="form-group">
	 <label for="user_image">Kép</label>
	  <input type="file"  name="image">
  </div-->


   <div class="form-group">
	  <input class="btn btn-primary" type="submit" name="add_user" value="Felhasználó hozzáadása">
  </div>


</form>

