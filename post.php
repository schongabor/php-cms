<?php require_once("includes/header.php"); ?>
<?php require_once("includes/db.php"); ?>

<!-- Navigation -->
<?php require_once("includes/navigation.php"); ?>
<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
        
        <?php
        
        if(isset($_GET["p_id"])){
        
            $post_id = $_GET["p_id"];
            
        }
        
        $query = "SELECT * FROM posts WHERE post_id = $post_id ";
        $select_all_posts_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_all_posts_query)){
        
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_image = $row["post_image"];
            $post_content = $row["post_content"];     
        
        ?>
                
        <h1 class="page-header">
            Varga Mama Sütödéje
            <small>Gabi néni receptjei</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
            <a href="#"><?php echo $post_title ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
        <p><?php echo $post_content ?></p>

        <hr>
        
        <?php
        
        }
        
        ?>
        <!-- Blog Comments -->
        <?php
        
            if(isset($_POST["create_comment"])){
                                    
                $the_post_id = $_GET["p_id"];
                
                $comment_author = $_POST["comment_author"];
                $comment_email = $_POST["comment_email"];
                $comment_content = $_POST["comment_content"];
                
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                
                        $query  = "INSERT INTO comments ";
                        $query .= "(comment_post_id, ";
                        $query .= "comment_author, ";
                        $query .= "comment_email, ";
                        $query .= "comment_content, ";
                        $query .= "comment_status, ";
                        $query .= "comment_date) ";

                        $query .= "VALUES ";
                        $query .= "($the_post_id, ";
                        $query .= "'{$comment_author}', ";
                        $query .= "'{$comment_email}', ";
                        $query .= "'{$comment_content}', ";
                        $query .= "'jóváhagyásra vár', ";
                        $query .= "now())";


                        $add_comment_query = mysqli_query($connection, $query);
                        if(!$add_comment_query){

                            die("QUERY FAILED".mysqli_error($connection));
                            
                        }

                        $query  = "UPDATE posts SET post_comment_count = post_comment_count+1 ";
                        $query .= "WHERE post_id = $the_post_id ";

                        $update_comment_count = mysqli_query($connection, $query);

                        if(!$update_comment_count){

                            die("QUERY FAILED".mysqli_error($connection));
                        }
                } else {
                
                        echo "<script>alert('A mezők nem lehetnek üresek')</script>";
                
                }
            }
            
        ?>
        <!-- Comments Form -->
        <div class="well">
            <h4>Szóljon hozzá:</h4>
            <form role="form" method="post" action="">
                
                <div class="form-group">
                    <label for="Author">Szerző</label>
                    <input type="text" name="comment_author" class="form-control" name="comment_author">
                </div>
                
                <div class="form-group">
                    <label for="E-Mail">E-Mail</label>
                    <input type="email" name="comment_email" class="form-control" name="comment_email">
                </div>
                
                <div class="form-group">
                    <label for="Hozzászólás">Hozzászólás</label>
                    <textarea name="comment_content" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="create_comment" class="btn btn-primary">Elküld</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <?php
        
            $query  = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' ";
            $query .= "AND comment_status = 'jóváhagyva' ";
            $query .= "ORDER by comment_id DESC ";
            
            $select_comment_query = mysqli_query($connection, $query);
            
            if(!$select_comment_query){
            
                die("query failed".mysqli_error($connection));
                
            }
            
            while($row = mysqli_fetch_assoc($select_comment_query)){
                
                $comment_date = $row["comment_date"];
                $comment_author = $row["comment_author"];
                $comment_content = $row["comment_content"];
        ?>
               
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author; ?>
                    <small><?php echo $comment_date; ?></small>
                </h4>
                <?php echo $comment_content; ?>
            </div>
        </div>
        
        <?php } ?>






        <!-- Comment -->

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php require_once("includes/sidebar.php"); ?>

</div>
<!-- /.row -->

<hr>
<!-- Footer -->
<?php include "admin/includes/admin_footer.php"; ?>
