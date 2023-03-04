<?php 
	session_start(); /* Starts the session */
	if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 960px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3">
                        <a href="logout.php" class="btn btn-danger pull-left"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                    <div class="mt-5 mb-3">
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Create Post</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM live_posts";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) >= 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Post URL</th>";
                                        echo "<th>Post Title</</th>";
                                        echo "<th>Post Description</th>";
                                        echo "<th>Post Content</th>";
                                        echo "<th>Redirect Link</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['live_video'] . "</td>";
                                        echo "<td>" . $row['post_title'] . "</td>";
                                        echo "<td>" . $row['post_description'] . "</td>";
                                        echo "<td>" . $row['post_content'] . "</td>";
                                        echo "<td>" . $row['post_document_replace'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="data.php?live_video='. $row['live_video'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?live_video='. $row['live_video'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?live_video='. $row['live_video'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>