<?php

	if(isset($_POST["create_post"])){

		$post_title = $_POST["post_title"];
		$post_author = $_POST["post_author"];
		$post_category_id = $_POST["post_category_id"];
		$post_status = $_POST["post_status"];
		
		$post_image = $_FILES["image"]["name"];
		$post_image_temp = $_FILES["image"]["tmp_name"];
		
		$post_tags = $_POST["post_tags"];
		$post_content = $_POST["post_content"];
		$post_date = date("y-m-d");
		
		move_uploaded_file($post_image_temp, "../images/$post_image");
		
		$query = "INSERT INTO posts(post_category_id, post_title, 
		post_author, post_date, post_image, post_content, post_tags, 
		post_status) VALUES('{$post_category_id}', 
		'{$post_title}', '{$post_author}', now(), '{$post_image}', 
		'{$post_content}', '{$post_tags}', '{$post_status}')";
		
		$add_post_query = mysqli_query($connection, $query); 
		
		confirm_query($add_post_query);
		
		$post_id = mysqli_insert_id($connection);
		
		echo "<p class='bg-success'>A poszt hozzáadása sikeresen megtörtént. <a href='../post.php?p_id={$post_id}'> Ugrás a poszthoz</a> vagy <a href='posts.php'> Vissza a posztok szerkesztéshez</a></p>";
 


	}

?>
<form action="" method="post" enctype="multipart/form-data">    
 
 
  <div class="form-group">
	 <label for="title">Cím</label>
	  <input type="text" class="form-control" name="post_title">
  </div>
  
  <div class="form-group">
	
	 <select class="form-control" name="post_category_id" id="post_category_id">
	    
	    <?php
	    
	      $query = "SELECT * FROM categories";
	      $post_categories = mysqli_query($connection, $query);

	      confirm_query($post_categories);
	      
	      while($row = mysqli_fetch_assoc($post_categories)){
	      
		$cat_id = $row["cat_id"];
		$cat_title = $row["cat_title"];
		
		echo "<option value='$cat_id'>{$cat_title}</option>";
		
	      }
	      

	    
	    ?>
	 
	 
	 </select>
  </div>


  <div class="form-group">
	 <label for="author">Szerző</label>
	  <input type="text" class="form-control" name="post_author">
  </div>
  
    <div class="form-group">
      <select name="post_status" class="form-control" id="">
	<option value="piszkozat">Poszt státusz</option>
	<option value="publikálva">publikálva</option>
	<option value="piszkozat">piszkozat</option>
      </select>
    </div>
    
<div class="form-group">
	 <label for="post_image">Kép</label>
	  <input type="file"  name="image">
  </div>

  <div class="form-group">
	 <label for="post_tags">Kulcsszavak</label>
	  <input type="text" class="form-control" name="post_tags">
  </div>
  
  <div class="form-group" id="">
	 <label for="post_content">Tartalom</label>
	 <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
	 </textarea>
  </div>
  
  

   <div class="form-group">
	  <input class="btn btn-primary" type="submit" name="create_post" value="Publikálás">
  </div>


</form>

