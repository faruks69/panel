<?php
//fetch data
//if(isset($_POST["live_video"]))
//{
$live_video = trim($_GET["live_video"]);
  if(!empty($live_video)){
 
define('DB_SERVER', 'niscambodia.com');
define('DB_USERNAME', 'panel');
define('DB_PASSWORD', 'GyocgEktH3YjkdMa');
define('DB_NAME', 'panel');

/* Attempt to connect to MySQL database */
$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($connect === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $query = "SELECT * FROM live_posts WHERE live_video = '".$live_video."'";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  $data["post_title"] = $row["post_title"];
  $data["post_description"] = $row["post_description"];
  $data["video_uploadDate"] = $row["video_uploadDate"];
  $data["video_thumbnailUrl"] = $row["video_thumbnailUrl"];
  $data["video_contentUrl"] = $row["video_contentUrl"];
    $data["video_duration"] = $row["video_duration"];
      $data["video_name"] = $row["video_name"];
        $data["video_startDate"] = $row["video_startDate"];
          $data["video_endDate"] = $row["video_endDate"];
          
          
            $data["post_content"] = $row["post_content"];
              $data["post_document_replace"] = $row["post_document_replace"];
                $data["post_no_script"] = $row["post_no_script"];
                }

 echo json_encode($data);
}
?>
