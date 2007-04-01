<!-- START: r_sidebar -->
<div id="r_sidebar">

<ul id="r_sidebarwidgeted">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

<li id="search">
<h2>Search</h2>
<?php include(TEMPLATEPATH."/searchform.php");?>

<?php /* This is only for letsmint.com domain to show the theme switcher and the theme downloads. You can remove this line if you wish. */ if ($_SERVER['HTTP_HOST']=="www.letsmint.com") {include $_SERVER['DOCUMENT_ROOT']."/themesdownloads.inc.php";} ?>

<li id="archives-yearly">
<h2>Archives - Yearly</h2>
<ul>
<?php
$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
foreach($years as $year) : 
?>
<li><a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a></li>
<?php endforeach; ?>
</ul>

<li id="archives-monthly">
<h2>Archives - Monthly</h2>
<ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul>
<!-- drop down alternative 
<form id="archiveform" action="">
<select name="archive_chrono" onchange="window.location =
(document.forms.archiveform.archive_chrono[document.forms.archiveform.archive_chrono.selectedIndex].value);">
<option value=''>Select a Month</option>
<?php get_archives('monthly','','option'); //working with the old syntax but unable to make it working with the new WP 2.x template tag ?>
</select>
</form>
-->

<li id="subscribe">
<h2>Subscribe</h2>
	<ul>
		<li><a href="<?php bloginfo_rss('rss2_url'); ?>" title="Articles (RSS)">Articles (RSS)</a></li>
		<li><a href="<?php bloginfo_rss('comments_rss2_url'); ?>" title="Comments (RSS)">Comments (RSS)</a></li>
	</ul>
	
<li id="links">
<h2>Links</h2>
	<ul>
	<?php get_links(-1, '<li>', '</li>', ' - '); ?>
	</ul>

<li id="meta">
<h2>Meta</h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a class="tr-linkcount" href="http://technorati.com/search/<?php echo $_SERVER['HTTP_HOST'];?>" rel="linkcount">Technorati Links</a></li>
		<?php wp_meta(); ?>
	</ul>
	
	<?php endif; ?>
	</ul>
		
</div>
<!-- END: r_sidebar -->
<div class="clearall"><!-- let me try and pull down the content div --></div>