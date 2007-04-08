<?php get_header(); ?>

<!-- START: content -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2><?php the_title(); ?></h2>
		<?php the_content(''); ?>
		<?php edit_post_link('Edit this Page', ' &#x2318; ', ''); ?>
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

<?php include(TEMPLATEPATH."/sidebar-alt.php");?>
<?php get_sidebar(); ?>
	
</div>
<!-- END: content -->
<?php get_footer(); ?>