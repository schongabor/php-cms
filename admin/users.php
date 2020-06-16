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
                            Üdv az admin oldalon
                            <small>Varga Mama</small>
                        </h1>
					
					<?php
					
						if(isset($_GET["source"])){
						
							$source = $_GET["source"];
						
						} else {
						
							$source = "";
													
						}	
						switch($source) {
						
							case "add_user";
							echo require_once("includes/add_user.php");
							break;
							
							case "update_user";
							echo require_once("includes/update_user.php");
							break;
							
							default:
							
								require_once("includes/view_all_users.php");
							
							break;
							
						}
												
					?>
					
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
<?php require_once("includes/admin_footer.php"); ?>
  
