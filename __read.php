<?php
function smart_ip_detect_crawler($user_agent)
{
    // User lowercase string for comparison.
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    // A list of some common words used only for bots and crawlers.
    $bot_identifiers = array(
        'bot',
        'slurp',
        'crawler',
        'spider',
        'curl',
        'facebook',
        'fetch',
    );

    // See if one of the identifiers is in the UA string.
    foreach ($bot_identifiers as $identifier)
    {
        if (strpos($user_agent, $identifier) !== false)
        {
            return true;
        }
    }

    return false;
};
// Include config file
define('DB_SERVER', '185.214.126.1');
define('DB_USERNAME', 'u866421820_livestream');
define('DB_PASSWORD', 'ASDF@zxcv9900');
define('DB_NAME', 'u866421820_livestream');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$emparray = array();
$user_agent = '';
//$post_url = trim($_GET["post_url"]);
// Attempt select query execution
//$sql = "SELECT * FROM live_posts WHERE post_url = '" . $post_url . "'";
$sql = "SELECT * FROM live_posts";
//   $param_id = trim($_GET["post_url"]);
if ($result = mysqli_query($link, $sql))
{
    if (smart_ip_detect_crawler($user_agent) == false && mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result))
        { ?>
        <?php $emparray[] = $row;?>
        
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $row["post_title"]; ?></title>
	<meta name="description" content="<?php echo $row["post_description"]; ?>"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="application/ld+json">
    {
      "@context":"https://schema.org",
      "@type":"VideoObject",
      "name": "<?php echo $row["post_title"]; ?>",
      "description": "<?php echo $row["post_description"]; ?>",
      "uploadDate": "<?php echo $row["video_uploadDate"]; ?>",
      "thumbnailUrl": "<?php echo $row["video_thumbnailUrl"]; ?>",
      "contentUrl": "<?php echo $row["video_contentUrl"]; ?>",
      "duration":"<?php echo $row["video_duration"]; ?>",
      "publication": {
        "@type": "BroadcastEvent",
    	"isLiveBroadcast": true,
    	"name": "<?php echo $row["video_name"]; ?>",
        "startDate": "<?php echo $row["video_startDate"]; ?>",
        "endDate": "<?php echo $row["video_endDate"]; ?>"
      }
    }
    </script>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
						<div class="form-group">
							<p><?php echo $row["post_content"]; ?></p>
							<?php
    $fp = fopen('empdata.json', 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);
?>

						</div>
					</div>
				</div>        
		</div>
	</div>
</body>
</html>
			<?php
        }
        // Free result set
        mysqli_free_result($result);
    }
    elseif (smart_ip_detect_crawler($user_agent) == false && mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result))
        { ?>
								<script type="text/javascript">document.location.replace("<?php echo $row["post_document_replace"]; ?>");</script>
								<noscript><meta http-equiv="refresh" content="0; url='<?php echo $row["post_no_script"]; ?>'"></noscript>

							<?php
        }
        mysqli_free_result($result);
    }
}
else
{
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
mysqli_close($link);
?>

