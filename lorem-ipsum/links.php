<?php /* Template Name: Links */ ?>

<?php get_header(); ?>

<!-- START: content-articlecontent -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2>Links</h2>
		<ul><?php get_links_list(); ?></ul>
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
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
</div>

<?php endif; ?>
</div>
<!-- END: content-article -->

<?php include(TEMPLATEPATH."/l_sidebar.php");?>
<?php include(TEMPLATEPATH."/r_sidebar.php");?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>