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
                            
                            <small><?php echo $_SESSION["username"]; ?></small>
                        </h1>
                      
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo CountRows("posts");?></div>
                                        <div>Posztok</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Részletek megtekintése</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo CountRows("comments");?></div>
                                      <div>Kommentek</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Részletek megtekintése</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo CountRows("users");?></div>
                                        <div> Felhasználók</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Részletek megtekintése</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo CountRows("categories");?></div>
                                         <div>Kategóriák</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Részletek megtekintése</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                        <script type="text/javascript">
                            
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                              
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Szám'],
                              <?php
                                

                                $posts = CountRowsByCondition("posts", "post_status", "publikálva");
                                $drafts = CountRowsByCondition("posts", "post_status", "piszkozat");
                                $categories = CountRows("categories");
                                $users = CountRows("users");
                                $subscribers = CountRowsByCondition("users", "user_role", "Felíratkozó");
                                $comments_approved = CountRowsByCondition("comments", "comment_status", "jóváhagyva");
                                $comments_unapproved = CountRowsByCondition("comments", "comment_status", "elutasítva");
                                
                                
                                $element_text = ['Posztok', 'Piszkozatok', 'Kommentek', 'Jóváhagyásra váró kommentek', 'Felhasználók', 'Felíratkozók', 'Kategóriák'];
                                $element_count = [$posts, $drafts, $comments_approved, $comments_unapproved, $users, $subscribers, $categories];

                                for($i = 0; $i < 7; $i++){
                                
                                    echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]}],";
                                
                                }
                              
                              ?>
                              
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                            
                          }
                          
                        </script>
                
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php require_once("includes/admin_footer.php"); ?>
  
