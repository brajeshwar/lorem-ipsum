<?php get_header(); ?>

<!-- START: content-articlecontent -->
<div id="content">

<!-- START: content-article -->
<div id="content-article">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="postmetadata"><?php the_time('M jS, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><?php edit_post_link('e', ' | ', ''); ?></p>
		<?php the_excerpt(); ?>
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