<?php
	include_once("bloggerClass.php");
	if(isset($_GET['url'])){
		$stream = new bloggerStream();
$stream->loadApi($_GET['url']);
$videoLink = $stream->grab(); //direct mp4 url
$posterImg = $stream->poster(); // poster image url
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Plyr.io Player -->
	<link rel="stylesheet" href="https://cdn.plyr.io/3.3.12/plyr.css">
</head>
<body style="margin:0px;">
	<video poster="<?php echo $posterImg; ?>" id="player" playsinline controls>
		<source src="<?php echo $videoLink;?>" type="video/mp4">
	</video>
	<!-- Plyr JS -->
	<script src="https://cdn.plyr.io/3.3.12/plyr.js"></script>
	<script>const player = new Plyr('#player');</script>
  </body>
</html>
