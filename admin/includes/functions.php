<?php

function confirm_query($result){
	
	global $connection;
	
	if(!$result){
			
		die("query failed: ".mysqli_error($connection));
			
	}

}


function insert_categories() {
	
	global $connection;
	
	if(isset($_POST["submit"])){
		
		$cat_title = $_POST["cat_title"];
		
		if($cat_title == "" || empty($cat_title)){
		
			echo "This field should not be empty";
		
		} else {
		
			$query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
			$create_category_query = mysqli_query($connection, $query);
			
			if(!$create_category_query){
			
				die("QUERY FAILED".mysqli_error($connection));
				
			}
		}
		
	}

}

function find_categories() {	

	global $connection;

	$query = "SELECT * FROM categories";
	$select_all_categories_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($select_all_categories_query)){
	
		$cat_id = $row["cat_id"];
		$cat_title = $row["cat_title"];
								
		echo "<tbody>";
			echo "<tr>";
				echo "<td>{$cat_id}</td>";
				echo "<td>{$cat_title}</td>";
				echo "<td><a href='categories.php?delete={$cat_id}'>delete</a></td>";
				echo "<td><a href='categories.php?update={$cat_id}'>update</a></td>";
			echo "</tr>";
		echo "</tbody>";

	}

}

function delete_categories() {

	global $connection;

	if(isset($_GET["delete"])){
		
		$del_cat_id = $_GET["delete"];									
		$query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
		$delete_categories_query = mysqli_query($connection, $query);
		header("Location: categories.php");
	}
	
}

function insert_posts() {

	global $connection;
	
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
		$post_content = $row["post_content"];
		$post_date = $row["post_date"];

		echo "<tr>";
		
			echo "<td>{$post_id}</td>";
			echo "<td>{$post_author}</td>";
			echo "<td>{$post_title}</td>";
			echo "<td>{$post_category_id}</td>";
			echo "<td>{$post_status}</td>";
			echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
			echo "<td>{$post_tags}</td>";
			echo "<td>{$post_content}</td>";
			echo "<td>{$post_date}</td>";
			echo "<td><a href='posts.php?update={$post_id}'>delete</a></td>";
			echo "<td><a href='posts.php?delete={$post_id}'>delete</a></td>";


		echo "</tr>";
	}
	
	
}

function CountRows($mysql_table_name){
	
	global $connection;
	
	$tablename = $mysql_table_name;

	$query = "SELECT * FROM {$tablename} ";
	$select_all_query = mysqli_query($connection, $query);
	$number_of_rows = mysqli_num_rows($select_all_query);
	
	if(!$number_of_rows){
			
		die("query failed: ".mysqli_error($connection));
			
	} else {
		
		return $number_of_rows;
		
	}

}

function CountRowsByCondition($mysql_table_name, $column_name, $condition){
	
	global $connection;
	
	$tablename = $mysql_table_name;
	$column_name = $column_name;
	$cond = $condition;
	
	$query = "SELECT * FROM $tablename WHERE $column_name = '$condition' ";
	$select_all_query = mysqli_query($connection, $query);
	$number_of_rows = mysqli_num_rows($select_all_query);
	
	if(!$number_of_rows){
			
		die($query."query failed: ".mysqli_error($connection));
			
	} else {
		
		return $number_of_rows;
		
	}

}

function crud_alert($method, $url){
	
	$method = $method;
	$url = $url;
	
	echo "<div class='bg-success' role='alert'>
	Az adatok ".$method." sikeresen megtörtént!
	</div>";
	header("Refresh: 2, URL=$url");	


}

function alert($message){
	
	$message = $message;
	echo "<div class='alert alert-dark' role='alert'>".$message."</div>";
	//header("Refresh: 2, URL=$url");	


}
