    <div class="col-md-4">
	
	
	
        <!-- Blog Search Well -->
        <div class="well">
            <h4>Keresés kulcsszóra</h4>
            <form method="post" action="search.php">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
            </form><!-- form search -->

            <!-- /.input-group -->
        </div>



        <!-- Blog Categories Well -->
        <div class="well">
                        
            <?php
            
            $query = "SELECT * FROM categories";
            $select_categories_sidebar_query = mysqli_query($connection, $query);
                        
            ?>
            
            <h4>Kategóriák</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
						    
						<?php
						
						    while($row = mysqli_fetch_assoc($select_categories_sidebar_query)){
			
							$cat_title = $row["cat_title"];
                            $cat_id = $row["cat_id"];
							echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
						
						}
						
						?>
						
                    </ul>
                </div>
                
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        
        <!-- Login -->
        <div class="well">
            <h4>Bejelentkezés</h4>
            <form method="post" action="includes/login.php">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Felhasználónév">
            </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Jelszó">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Bejelentkezés
                        </button>
                    </span>
                </div>
            </form>

            <!-- /.input-group -->
        </div>


        <!-- Side Widget Well -->
		<?php require_once("widget.php"); ?>

    </div>
