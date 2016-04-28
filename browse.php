<?php
  require 'main.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SWE Project</title>

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/project.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jqcloud.css" />


</head>

<body>

<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                <a class="navbar-brand" href="browse.php">Hangout Hunter</a>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                    <!-- <li>
                        <a href="">About</a>
                    </li> -->
                    <!-- <li> -->
                        <!-- <a>Welcome user</a> -->
                        <!-- <a id = "welcome"></a> -->
                    <!-- </li> -->
                    <li>
                        <a href="?logout">Logout</a>
                    </li>
                </ul>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <div id="imaginary_container"> 
                    <div class="input-group stylish-input-group">
                        <input id="search-box" type="text" class="form-control"  placeholder="Search for Cities" >
                        <span class="input-group-addon">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                  <div id="suggesstion-box">
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
          <div class="container-fluid">
              <ul class="nav nav-tabs" id="parent-list">
                <li class="active"><a data-toggle="tab" href="#business_info">Business Info</a></li>
                <li><a data-toggle="tab" href="#review_summary">Word Cloud</a></li>
                <li><a data-toggle="tab" href="#my_review">My Review</a></li>
              </ul>

              <div class="tab-content">
                <div id="business_info" class="tab-pane fade in active">

                </div>
                <div id="review_summary" class="tab-pane fade">
                <div id="word_cloud" style="height: 400px; width: 720px;"></div>
                  <!-- <h3>Reviews</h3> -->
                  <!-- <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                </div>
                <div id="my_review" class="tab-pane fade">
                  <h3>User Reviews</h3>
                  <div id="reviews">
                  <p id="review_para">No Reviews found.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div id="review-body" style="width: 600px; height: 400px;">
            No Reviews
            </div>  -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <!-- <a id="word-cloud" class="list-group-item ">Get Word Cloud</a> -->
                    <!-- <a id="clear-cloud" class="list-group-item ">Clear</a> -->
                  
                  <div class="container">
                    <h4>Business Types</h4>
                    <form id="filter_form" role="form" action="" method="post">
                      <div class="checkbox">
                        <label><input type="checkbox" name="categoryArr[]" value="Arts-Entertainment">Arts & Entertainment</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" name="categoryArr[]" value="Automotive">Automotive</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" name="categoryArr[]" value="Beauty-Spas">Beauty & Spas</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" name="categoryArr[]" value="Restaurants">Restaurants</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" name="categoryArr[]" value="Shopping">Shopping</label>
                      </div>
                  </div>
                    <br>
                    <div>
                        <h4>Ratings</h4>
                        <input id="slider" name="rating" type=range multiple min=0 max=5 step="0.5" value="0.0">
                    </div>
                    <br>
                    <div class="checkbox">
                        <label><input type="checkbox" name="visited" value="visited">View my visited places</label>
                      </div>
                    <br>
                     <button class="list-group-item active" id="filter" type="submit" name="filter" value="filter">Filter</button>

                </div>
            </form>
            </div>

            <div class="col-md-9">
                <div class="thumbnail">
                    <div id="map-canvas" style="width: 900px; height: 420px;"></div>

                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->

    <!-- <div class="container"> -->

        <!-- Footer -->
        <!-- <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Submitted By: Group 10</p>
                </div>
            </div>
        </footer>

    </div> -->
    <!-- /.container -->

    <!-- script references -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- <script src="http://maps.googleapis.com/maps/api/js"></script> -->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDgnkclVTMrcELYURLVmZ5mdZ9Z_HH2OQ0&libraries=places"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jqcloud.js"></script>
    <script src="js/scripts.js"></script>
    
</body>

</html>
