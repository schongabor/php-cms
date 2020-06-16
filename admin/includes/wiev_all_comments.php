	<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Szerző</th>
			<th>Hozzászólás</th>
			<th>E-Mail</th>
			<th>Státusz</th>
			<th>Cikkel kapcsolatban</th>
			<th>Dátum</th>
			<th>Jóváhagy</th>
			<th>Elutasít</th>
			<th>Töröl</th>
		</tr>
	</thead>
	<tbody>

	<?php
		
	$query = "SELECT * FROM comments ORDER BY comment_id DESC";
	$select_all_comments_query = mysqli_query($connection, $query);
	
	while($row = mysqli_fetch_assoc($select_all_comments_query)){
	
		$comment_id = $row["comment_id"];
		$comment_post_id = $row["comment_post_id"];
		$comment_author = $row["comment_author"];
		$comment_content = $row["comment_content"];
		$comment_email = $row["comment_email"];
		$comment_status = $row["comment_status"];
		$comment_date = $row["comment_date"];

		echo "<tr>";
		
			echo "<td>{$comment_id}</td>";
			echo "<td>{$comment_author}</td>";
			echo "<td>{$comment_content}</td>";
			/*
			$query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
			$select_categories_for_update_query = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($select_categories_for_update_query)){
			
				$cat_id = $row["cat_id"];
				$cat_title = $row["cat_title"];			
		
			}	
			*/
			echo "<td>{$comment_email}</td>";			
			echo "<td>{$comment_status}</td>";
			
			$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
			$select_post_id_query = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($select_post_id_query)){
				
				$post_id = $row["post_id"];
				$post_title = $row["post_title"];
				
			}
			
			echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
			
			
			echo "<td>{$comment_date}</td>";
			echo "<td><a href='comments.php?approve={$comment_id}'>Jóváhagy</a></td>";
			echo "<td><a href='comments.php?unapprove={$comment_id}'>Elutasít</a></td>";
			echo "<td><a href='comments.php?delete={$comment_id}'>Töröl</a></td>";

		echo "</tr>";
	}
	
	?>
	
	<?php
	
		if(isset($_GET["approve"])){
			
			$comment_id = $_GET["approve"];
			
			$query = "UPDATE comments SET comment_status = 'jóváhagyva' WHERE comment_id = '{$comment_id}' ";
			$approve_comment_query = mysqli_query($connection, $query);
			header("Location: comments.php");
		
		}
		
		if(isset($_GET["unapprove"])){
		
			$comment_id = $_GET["unapprove"];
			
			$query = "UPDATE comments SET comment_status = 'elutasítva' WHERE comment_id = '{$comment_id}' ";
			$unapprove_comment_query = mysqli_query($connection, $query);
			header("Location: comments.php");
		
		}
	
		if(isset($_GET["delete"])){
		
			$comment_id = $_GET["delete"];
			
			$query = "DELETE FROM comments WHERE comment_id = '{$comment_id}' ";
			$delete_post_query = mysqli_query($connection, $query);
			header("Location: comments.php");
		
		}
		
	?>
	</tbody>
	</table>
