	<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Felhasználónév</th>
			<th>Vezetéknév</th>
			<th>Keresztnév</th>
			<th>Email</th>
			<th>Jogosultság</th>
			<th>Adminisztrátorrá tesz</th>
			<th>Feliratkozóvá tesz</th>
			<th>Szerkeszt</th>
			<th>Töröl</th>
		</tr>
	</thead>
	<tbody>

	<?php
		
	$query = "SELECT * FROM users";
	$select_all_users_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($select_all_users_query)){
	
		$user_id = $row["user_id"];
		$username = $row["username"];
		$user_lastname = $row["user_lastname"];
		$user_firstname = $row["user_firstname"];
		$user_email = $row["user_email"];
		$user_role = $row["user_role"];

		echo "<tr>";
		
			echo "<td>{$user_id}</td>";
			echo "<td>{$username}</td>";
			echo "<td>{$user_lastname}</td>";
			echo "<td>{$user_firstname}</td>";						
			echo "<td>{$user_email}</td>";
			echo "<td>{$user_role}</td>";
			echo "<td><a href='users.php?change_to_admin={$user_id}'>Adminisztrátor</a></td>";
			echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Felíratkozó</a></td>";
			echo "<td><a href='users.php?source=update_user&update_user={$user_id}'>Szerkeszt</a></td>";
			echo "<td><a href='users.php?delete={$user_id}'>Töröl</a></td>";


		echo "</tr>";
	}
	
	?>
	
	<?php
		
		if(isset($_GET["change_to_admin"])){
		
			$user_id = $_GET["change_to_admin"];
			
			$query = "UPDATE users SET user_role = 'Adminisztrátor' WHERE user_id = '{$user_id}' ";
			$delete_user_query = mysqli_query($connection, $query);
			header("Location: users.php");
		
		}
		
		if(isset($_GET["change_to_subscriber"])){
		
			$user_id = $_GET["change_to_subscriber"];
			
			$query = "UPDATE users SET user_role = 'Felíratkozó' WHERE user_id = '{$user_id}' ";
			$delete_user_query = mysqli_query($connection, $query);
			header("Location: users.php");
		
		}
	
		if(isset($_GET["delete"])){
		
			$user_id = $_GET["delete"];
			
			$query = "DELETE FROM users WHERE user_id = '{$user_id}' ";
			$delete_user_query = mysqli_query($connection, $query);
			header("Location: users.php");
		
		}
		
	?>
	</tbody>
	</table>
