
<form action="" method="post">
	<div class="form-group">
		<label for="cat-title">Kategóriák szerkesztése</label>
		
		<?php
			
			if(isset($_GET["update"])){
			
				$update_cat_id = $_GET["update"];
				
				$query = "SELECT * FROM categories WHERE cat_id = $update_cat_id";
				$select_categories_for_update_query = mysqli_query($connection, $query);
				
				while($row = mysqli_fetch_assoc($select_categories_for_update_query)){
				
					$cat_id = $row["cat_id"];
					$cat_title = $row["cat_title"];
					
		?>
		
		<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
		
		<?php	
				}
				
			}
			
		?>
		
		<?php //update query

		if(isset($_POST["update_category"])){
			
			$update_cat_title = $_POST["cat_title"];									
			$query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = '{$cat_id}' ";
			$update_categories_query = mysqli_query($connection, $query);
			if(!$update_categories_query){
				
				die("QUERY FAILED").mysqli_error($connection);
			
			}
		}

	?>
		
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
	</div>						
</form>
