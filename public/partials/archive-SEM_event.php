<?php

/**
 * Provide an archive view for the Special Event post type.
 *
 * @link       https://github.com/allilevine/Special-Event-Manager-WordPress-Plugin
 * @since      1.0.0
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/admin/partials
 */
?>

<?php get_header(); ?>

<h1 class="archive-title h2">Upcoming <?php post_type_archive_title(); ?></h1>
	<?php echo '<ul class="events-module">';
	if (have_posts()) : while (have_posts()) : the_post();

		// Get event dates & times from custom field
		$post_id = $wp_query->post->ID;
		$custom_fields = get_post_custom($post_id);
	    $meta_sd = $custom_fields["sem_events_startdate"][0];
	    $meta_ed = $custom_fields["sem_events_enddate"][0];
	    $meta_st = $meta_sd;
	    $meta_et = $meta_ed;

		// Format dates & times
		$clean_dayofweek = date("l", $meta_sd);
	    $clean_sd = date("F j", $meta_sd);
	    $clean_ed = date("j", $meta_ed);
	    $clean_st = date("g:i a", $meta_st);
	    $clean_et = date("g:i a", $meta_et);
		$compare_sd = date("j", $meta_sd);

		// If later than today at 6am, continue
		$today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

	  	if ($meta_ed == 0) {
	  		$post_event_time = $meta_sd;
	  	} else if (!(is_null($meta_ed))) {
			$post_event_time = $meta_ed;
		  }

		if ( $post_event_time > $today6am ) {

		//Get the Thumbnail URL
		$futuresrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 350,355 ), false, '' );
		?>
		 <li style="background: url('<?php echo $futuresrc[0]; ?>') no-repeat top left">
		  <a href="<?php the_permalink(); ?>">
  				  	<?php

					// Display dates & times
  				  	if (($meta_ed == 0) || ($compare_sd == $clean_ed)) { ?>
					  	<div class="event-dayofweek"><?php echo $clean_dayofweek; ?></div>
						<div class="event-month"><?php echo $clean_sd; ?></div>
						<div class="event-time"><?php echo $clean_st; ?></div>
					<?php } else if (!(is_null($clean_ed))) { ?>
					  	<div class="event-dayofweek"><?php echo $clean_sd . '-' . $clean_ed; ?></div>
  					  <?php } ?>
					<div class="event-title"><?php the_title() ?></div>
				</a>
			  </li>
			  <?php } //end if ?>


			    <?php endwhile; ?>
			</ul>

			<?php wp_reset_postdata(); ?>

			<?php endif;
?>

<!-- Past Events start here -->
<h1 class="archive-title h2" style="padding-top:20px;">Past <?php post_type_archive_title(); ?></h1>
<?php
$past_events = new WP_Query('post_type=sem_event');
if ( $past_events->have_posts() ) :
	?>
<ul class="events-module">

	<!-- the loop -->
	<?php
	while ( $past_events->have_posts() ) : $past_events->the_post();

	// Get event dates & times from custom field
	$custom_fields = get_post_custom($post->ID);
		$meta_sd = $custom_fields["sem_events_startdate"][0];
		$meta_ed = $custom_fields["sem_events_enddate"][0];
		$meta_st = $meta_sd;
		$meta_et = $meta_ed;

		// Format dates & times
		$clean_dayofweek = date("l", $meta_sd);
			$clean_sd = date("F j", $meta_sd);
			$clean_ed = date("j", $meta_ed);
			$clean_st = date("g:i a", $meta_st);
			$clean_et = date("g:i a", $meta_et);
		$compare_sd = date("j", $meta_sd);

		// If earlier than today at 6am, continue
		$today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

			if ($meta_ed == 0) {
				$post_event_time = $meta_sd;
			} else if (!(is_null($meta_ed))) {
			$post_event_time = $meta_ed;
			}

		if ( $post_event_time < $today6am ) {


		//Get the Thumbnail URL
		$pastsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 350,355 ), false, '' );
		?>
		<li style="background: url('<?php echo $pastsrc[0]; ?>') no-repeat top left">
			<a href="<?php the_permalink(); ?>">
				<?php

			// Display dates & times
				if (($meta_ed == 0) || ($compare_sd == $clean_ed)) { ?>
					<div class="event-dayofweek"><?php echo $clean_dayofweek; ?></div>
				<div class="event-month"><?php echo $clean_sd; ?></div>
				<div class="event-time"><?php echo $clean_st; ?></div>
			<?php } else if (!(is_null($clean_ed))) { ?>
					<div class="event-dayofweek"><?php echo $clean_sd . '-' . $clean_ed; ?></div>
<?php } ?>
<div class="event-title"><?php the_title() ?></div>
</a>
</li>
<?php } //end if ?>
	<?php endwhile; ?>
	<!-- end of the loop -->
	</ul>

			<?php wp_reset_postdata(); ?>

	<?php endif;
?>

</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
