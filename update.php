<?php
// Include config file
	session_start(); /* Starts the session */
	if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
	}
	require_once "config.php";
 
// Define variables and initialize with empty values
$post_url = $post_title = $post_description = $video_uploadDate = $video_thumbnailUrl = $video_contentUrl = $video_duration = $video_name = $video_startDate = $video_endDate = $post_content = $post_document_replace = "";
$post_url_err = $post_title_err  = $post_description_err  = $video_uploadDate_err = $video_thumbnailUrl_err = $video_contentUrl_err = $video_duration_err = $video_name_err = $video_startDate_err = $video_endDate_err = $post_content_err  = $post_document_replace_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
// Validate post_url
    $input_post_url = trim($_POST["post_url"]);
    if(empty($input_post_url)){
        $post_url_err = "Please enter an post_url.";     
    } else{
        $post_url = $input_post_url;
    }   
    // Validate post_title
    $input_post_title = trim($_POST["post_title"]);
    if(empty($input_post_title)){
        $post_title_err = "Please enter an post_title.";     
    } else{
        $post_title = $input_post_title;
    }    
// Validate post_description
    $input_post_description = trim($_POST["post_description"]);
    if(empty($input_post_description)){
        $post_description_err = "Please enter an post_description.";     
    } else{
        $post_description = $input_post_description;
    }
// Validate video_uploadDate
    $input_video_uploadDate = trim($_POST["video_uploadDate"]);
    if(empty($input_video_uploadDate)){
        $video_uploadDate_err = "Please enter an video_uploadDate.";     
    } else{
        $video_uploadDate = $input_video_uploadDate;
    }
// Validate video_thumbnailUrl
    $input_video_thumbnailUrl = trim($_POST["video_thumbnailUrl"]);
    if(empty($input_video_thumbnailUrl)){
        $video_thumbnailUrl_err = "Please enter an video_uploadDate.";     
    } else{
        $video_thumbnailUrl = $input_video_thumbnailUrl;
    }
// Validate video_contentUrl
    $input_video_contentUrl = trim($_POST["video_contentUrl"]);
    if(empty($input_video_contentUrl)){
        $video_contentUrl_err = "Please enter an video_contentUrl.";     
    } else{
        $video_contentUrl = $input_video_contentUrl;
    }
// Validate video_duration
    $input_video_duration = trim($_POST["video_duration"]);
    if(empty($input_video_duration)){
        $video_duration_err = "Please enter an video_duration.";     
    } else{
        $video_duration = $input_video_duration;
    }

// Validate video_name
    $input_video_name = trim($_POST["video_name"]);
    if(empty($input_video_name)){
        $video_name_err = "Please enter an video_name.";     
    } else{
        $video_name = $input_video_name;
    }

// Validate video_startDate
    $input_video_startDate = trim($_POST["video_startDate"]);
    if(empty($input_video_startDate)){
        $video_startDate_err = "Please enter an video_startDate.";     
    } else{
        $video_startDate = $input_video_startDate;
    }

// Validate video_endDate
    $input_video_endDate = trim($_POST["video_endDate"]);
    if(empty($input_video_endDate)){
        $video_endDate_err = "Please enter an video_endDate.";     
    } else{
        $video_endDate = $input_video_endDate;
    }
// Validate post_content
    $input_post_content = trim($_POST["post_content"]);
    if(empty($input_post_content)){
        $post_content_err = "Please enter an post_content.";     
    } else{
        $post_content = $input_post_content;
    }
// Validate post_document_replace
    $input_post_document_replace = trim($_POST["post_document_replace"]);
    if(empty($input_post_document_replace)){
        $post_document_replace_err = "Please enter an post_document_replace.";     
    } else{
        $post_document_replace = $input_post_document_replace;
    }	
    
    // Check input errors before inserting in database
    if(empty($post_url_err) && empty($post_title_err) && empty($post_description_err) && empty($video_uploadDate_err) && empty($video_thumbnailUrl_err) && empty($video_contentUrl_err) && empty($video_duration_err) && empty($video_name_err) && empty($video_startDate_err) && empty($video_endDate_err) && empty($post_content_err) && empty($post_document_replace_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO live_posts (post_url, post_title, post_description, video_uploadDate, video_thumbnailUrl, video_contentUrl, video_duration, video_name, video_startDate, video_endDate, post_content, post_document_replace) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_post_url, $param_post_title, $param_post_description, $param_video_uploadDate, $param_video_thumbnailUrl, $param_video_contentUrl, $param_video_duration, $param_video_name, $param_video_startDate, $param_video_endDate, $param_post_content, $param_post_document_replace);
            
            // Set parameters
            $param_post_url = $post_url;
            $param_post_title = $post_title;
            $param_post_description = $post_description;
			$param_video_uploadDate = $video_uploadDate;
			$param_video_thumbnailUrl = $video_thumbnailUrl;
			$param_video_contentUrl = $video_contentUrl;
			$param_video_duration = $video_duration;
			$param_video_name = $video_name;
			$param_video_startDate = $video_startDate;
			$param_video_endDate = $video_endDate;
			$param_post_content = $post_content;
			$param_post_document_replace = $post_document_replace;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
        .wrapper{
            width: 960px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Video Post Record</h2>
                    <p>Please fill this form and submit to add Video Post record to the database.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Post URL (team-vs-team-live-stream)</label>
                            <textarea name="post_url" class="form-control <?php echo (!empty($post_url_err)) ? 'is-invalid' : ''; ?>"><?php echo $post_url; ?></textarea>
                            <span class="invalid-feedback"><?php echo $post_url_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Post Title (Video Unique Title)</label>
                            <textarea name="post_title" class="form-control <?php echo (!empty($post_title_err)) ? 'is-invalid' : ''; ?>"><?php echo $post_title; ?></textarea>
                            <span class="invalid-feedback"><?php echo $post_title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Post Description (Meta Descriptoin)</label>
                            <textarea name="post_description" class="form-control <?php echo (!empty($post_description_err)) ? 'is-invalid' : ''; ?>"><?php echo $post_description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $post_description_err;?></span>
                        </div>											
						<div class="form-group">
                            <label>video uploadDate (yy-mm-dd)</label>
                            <textarea name="video_uploadDate" class="form-control <?php echo (!empty($video_uploadDate_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_uploadDate; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_uploadDate_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video thumbnailUrl(Image Exact URL http://example.com/video.jpg)</label>
                            <textarea name="video_thumbnailUrl" class="form-control <?php echo (!empty($video_thumbnailUrl_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_thumbnailUrl; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_thumbnailUrl_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video contentUrl (Exact Video Link http://example.com/video.mp4)</label>
                            <textarea name="video_contentUrl" class="form-control <?php echo (!empty($video_contentUrl_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_contentUrl; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_contentUrl_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video duration (T01H46M10S)</label>
                            <textarea name="video_duration" class="form-control <?php echo (!empty($video_duration_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_duration; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_duration_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video name (Team Vs Team Live Stream)</label>
                            <textarea name="video_name" class="form-control <?php echo (!empty($video_name_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_name; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_name_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video startDate(2021-08-10T21:45:01+00:00)</label>
                            <textarea name="video_startDate" class="form-control <?php echo (!empty($video_startDate_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_startDate; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_startDate_err;?></span>
                        </div>
						<div class="form-group">
                            <label>video endDate (2021-08-10T22:57:05+00:00)</label>
                            <textarea name="video_endDate" class="form-control <?php echo (!empty($video_endDate_err)) ? 'is-invalid' : ''; ?>"><?php echo $video_endDate; ?></textarea>
                            <span class="invalid-feedback"><?php echo $video_endDate_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>POST CONTENT(Body Article)</label>
                            <textarea name="post_content" class="form-control <?php echo (!empty($post_content_err)) ? 'is-invalid' : ''; ?>"><?php echo $post_content; ?></textarea>
                            <span class="invalid-feedback"><?php echo $post_content_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>POST Landing Page Link (Affiliate Landing Page Link)</label>
                            <textarea name="post_document_replace" class="form-control <?php echo (!empty($post_document_replace_err)) ? 'is-invalid' : ''; ?>"><?php echo $post_document_replace; ?></textarea>
                            <span class="invalid-feedback"><?php echo $post_document_replace_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>