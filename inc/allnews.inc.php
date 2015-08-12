<?php
require_once('simplepie/simplepie.php');
// We'll process this feed with all of the default options.
$feed = new SimplePie();
// Set which feed to process.

$feed->set_feed_url('http://api.flons.org/feed/feed.php');
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();
?>

<ul>

	<?php
	/*
	Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
	*/
  foreach ($feed->get_items(0, 7) as $item):
  $source = $item->get_item_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'source');
	?>
 
		<li class="item">
			<a href="<?php echo $item->get_permalink(); ?>" target="_window"><?php echo $item->get_title(); ?></a>
      <p><small><?php echo $item->get_date('j.n.Y, G:i \U\h\r'); ?> from <?php echo $source[0]['data']; ?></small></p>
		</li>
 
	<?php 
	endforeach; ?>
</ul>

