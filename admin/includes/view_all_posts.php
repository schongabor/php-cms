
<?php


if(isset($_POST["checkBoxArray"])){
	
	foreach($_POST["checkBoxArray"] as $postValueId){
	
		$bulk_options = $_POST["bulk_options"];
		
		switch($bulk_options){
		
			case "publikálva":
			$query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId} ";
			$update_to_publiched_status = mysqli_query($connection, $query);
			confirm_query($update_to_publiched_status);
			break;
			
			case "piszkozat":
			$query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$postValueId} ";
			$update_to_draft_status = mysqli_query($connection, $query);
			confirm_query($update_to_draft_status);
			break;
			
			case "törlés":
			$query = "DELETE FROM posts WHERE post_id={$postValueId} ";
			$delete_post_query = mysqli_query($connection, $query);
			confirm_query($delete_post_query);
			break;
		
		}
		
	
	}
	
}

?>
<form action="" method="post">
	<table class="table table-hover">
	
	<div id="bulkOptionsContainer" class="col-xs-4">
		
		<select class="form-control" name="bulk_options" id="">
		
			<option value="">Választási lehetőségek</option>
			<option value="publikálva">Publikálás</option>
			<option value="piszkozat">Piszkozat</option>
			<option value="törlés">Törlés</option>
		
		</select>
		
	</div>
	
	<div class="col-xs-4">
	
		<input type="submit" name="submit" class="btn btn-success" value="Jóváhagyás">
		<a class="btn btn-primary" href="posts.php?source=add_post"> Új bejegyzés létrehozása</a>
	
	</div>
	
	<thead>
		<tr>
			<th><input type="checkbox" id="selectAllBoxes"> Összes kiválasztása</th>
			<th>Id</th>
			<th>Szerző</th>
			<th>Cím</th>
			<th>Kategória</th>
			<th>Státusz</th>
			<th>Kép</th>
			<th>Tegek</th>
			<th>Kommentek száma</th>
			<th>Dátum</th>
			<th>Megtekintés</th>
			<th>Szerkeszt</th>
			<th>Töröl</th>
		</tr>
	</thead>
	<tbody>

	<?php
		
	$query = "SELECT * FROM posts";
	$select_all_posts_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($select_all_posts_query)){
	
		$post_id = $row["post_id"];
		$post_author = $row["post_author"];
		$post_title = $row["post_title"];
		$post_category_id = $row["post_category_id"];
		$post_status = $row["post_status"];
		$post_image = $row["post_image"];
		$post_tags = $row["post_tags"];
		$post_comment_count = $row["post_comment_count"];
		$post_date = $row["post_date"];

		echo "<tr>";
			
			echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$post_id}'></td>";
			echo "<td>{$post_id}</td>";
			echo "<td>{$post_author}</td>";
			echo "<td>{$post_title}</td>";
		
			$query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
			$select_categories_for_update_query = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($select_categories_for_update_query)){
			
				$cat_id = $row["cat_id"];
				$cat_title = $row["cat_title"];			
		
			}	
			echo "<td>{$cat_title}</td>";
						
			echo "<td>{$post_status}</td>";
			echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
			echo "<td>{$post_tags}</td>";
			echo "<td>{$post_comment_count}</td>";
			echo "<td>{$post_date}</td>";
			echo "<td><a href='../post.php?p_id={$post_id}'>Poszt megtekintése</a></td>";
			echo "<td><a href='posts.php?source=update_post&p_id={$post_id}'>Szerkeszt</a></td>";
			echo "<td><a onClick=\"javascript: return confirm('Biztos vagy benne, hogy törölni szeretnéd?') \" href='posts.php?delete={$post_id}'>Töröl</a></td>";


		echo "</tr>";
	}
	
	?>
	
	<?php
	
		if(isset($_GET["delete"])){
		
			$post_id = $_GET["delete"];
			
			$query = "DELETE FROM posts WHERE post_id = '{$post_id}' ";
			$delete_post_query = mysqli_query($connection, $query);
			header("Location: posts.php");
		
		}
		
	?>
	</tbody>
	</table>
</form>
