<?php /* Template Name: Archives */ ?>

<?php get_header(); ?>

<!-- START: content-articlecontent -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2>Archives - Yearly</h2>
		<ul>
		<?php
		$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
		foreach($years as $year) : 
		?>
		<li><a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="post">
		<h2>Archives - Monthly</h2>
		<ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul>
	</div>
	<div class="post">
		<h2>Categories</h2>
		<ul><?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?></ul>
	</div>
	<div class="post">
		<h2>The Last 100 Article (if available)</h2>
		<ul><?php wp_get_archives('type=postbypost&limit=100&format=html'); ?></ul>
	</div>

<?php endwhile; ?>

<!-- START: navigation -->
<div class="navigation">
	<div class="alignleft"><?php next_posts_link('&#x21E4; Previous Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Next Entries &#x21E5;') ?></div>
</div>
<!-- END: navigation -->

<?php else : ?>

<div class="post">
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here. Looks like the site does not have articles yet!</p>
</div>

<?php endif; ?>
</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>