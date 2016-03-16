<?php
@include(get_template_directory_uri().'/assets/scripts/plugins/TweetPHP.php');

$TweetPHP = new TweetPHP(array(
  'consumer_key'              => 'xxxxxxxxxxxxxxxxxxxxx',
  'consumer_secret'           => 'xxxxxxxxxxxxxxxxxxxxx',
  'access_token'              => 'xxxxxxxxxxxxxxxxxxxxx',
  'access_token_secret'       => 'xxxxxxxxxxxxxxxxxxxxx',
  'twitter_screen_name'       => 'yourusername'
));

echo $TweetPHP->get_tweet_list();

?>