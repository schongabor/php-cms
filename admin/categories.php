<?php require_once("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Üdv az Admin oldalon
                            <small>Szerző neve</small>
                        </h1>
						<div class="col-xs-6">
							
						<?php insert_categories(); ?>
							
							<form action="" method="post">
								<div class="form-group">
									<label for="cat-title">Kategória hozzáadása</label>
									<input class="form-control" type="text" name="cat_title">
								</div>
								<div class="form-group">
									<input class="btn btn-primary" type="submit" name="submit" value="Add category">
								</div>						
							</form>
							
							<?php //update and include query
							
							if(isset($_GET["update"])){
								
								$cat_id = $_GET["update"];
								
								require_once("includes/update_categories.php"); 
							
							}
							
							?>
														
						</div>
						<div class="col-xs-6">
							<table class="table table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Kategórai neve</th>
                                    <th>Szerkeszt</th>
                                    <th>Töröl</th>
								</thead>
								
								<?php find_categories() ?>
								<?php delete_categories() ?>
								
							</table>
						</div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php require_once("includes/admin_footer.php"); ?>
  
