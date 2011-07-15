<?php
		$linkcolor = $variables['linkcolor'];
		$backgroundcolor = $variables['backgroundcolor'];
		$customcss = $variables['customcss'];
		echo '<style type="text/css">';
		echo '#super-twitter-widget {';
		echo 'background: '. $backgroundcolor .';';
		echo '}';
		echo '#super-twitter-widget a {';
				echo 'color: '.$linkcolor .';';
		echo '}';
		echo $row['customcss'];
		echo '</style>';
?>
<div id="super-twitter-widget">
<?php 
	$url = 'sites/default/files/twitter-feed/tweets.json';
	$json_a=json_decode(file_get_contents($url),true);
	$userPic = $json_a[0]['user']['profile_image_url'];
	$userName = $json_a[0]['user']['name'];
	$screenName = $json_a[0]['user']['screen_name'];
?>
<h2>Recent Tweets</h2>
<?php
	print '<a href="http://twitter.com/'.$screenName.'"><img src="'.$userPic.'" alt="@'.$userName.' Twitter Feed"/></a>';
	print '<a href="http://twitter.com/'.$screenName.'">@'.$screenName.'</a>';
	
	print '<ul>';
	foreach($json_a as $tweets) {
		$textOut = makelinks($tweets['text']);
		$textOut = makeHash($textOut);
		$postDate = date('l d, Y h:ia', strtotime($tweets['created_at']));
		$tweetUrl = 'http://twitter.com/#!/'.$tweets['user']['screen_name'].'/status/'.number_format($tweets['id'], 0, '.', '');
		$postDateOut = l($postDate, $tweetUrl);
		echo '<li>'.$textOut.' - '.$postDateOut.'</li>';
	}
	print '</ul>';
?>
</div>