<?php

/**
 * Provide a single view for the Special Event post type.
 *
 * @link       https://github.com/allilevine/Special-Event-Manager-WordPress-Plugin
 * @since      1.0.0
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/admin/partials
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<?php

// Get event dates & times from custom field
	$post_id = $wp_query->post->ID;
	$custom_fields = get_post_custom($post_id);
	$meta_sd = $custom_fields["sem_events_startdate"][0];
	$meta_ed = $custom_fields["sem_events_enddate"][0];
	$meta_st = $meta_sd;
	$meta_et = $meta_ed;

	// Format dates & times
	$clean_sd = date("D, M d, Y", $meta_sd);
	$clean_ed = date("D, M d, Y", $meta_ed);
	$clean_st = date("g:i a", $meta_st);
	$clean_et = date("g:i a", $meta_et);

    // Start the loop.
		while ( have_posts() ) : the_post();

    // If later than today at 6am
    $today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

    if ($meta_ed == 0) {
      $post_event_time = $meta_sd;
    } else if (!(is_null($meta_ed))) {
      $post_event_time = $meta_ed;
      }


    if ( $post_event_time > $today6am ) {
      if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 6 ); }
    }
    ?>
<div style="float:left;width:46%;">
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title event-title">', '</h1>' );

      echo '<h3>';
        // Display dates & times
          if ($meta_ed == 0) {
            echo $clean_sd . ' at ' . $clean_st;
          } else if ($clean_sd == $clean_ed) {
          echo $clean_sd . ' from ' . $clean_st . ' to ' . $clean_et;
        } else if (!(is_null($clean_ed))) {
          echo $clean_sd . ' at ' . $clean_st . ' - ' . $clean_ed . ' at ' . $clean_et;
          }

      echo '</h3>';


      // Get featured image
$featuredsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 250,255 ), false, '' );

// Display featured image
if ($featuredsrc) {
  echo '<img src="' . $featuredsrc[0] . '" class="event-image" />';
}

      if ( $post_event_time > $today6am ) {
          echo '<p><a href="#ninja_forms_form_3_all_fields_wrap" class="btn">BOOK TABLE NOW</a></p>';
      }

      ?>

      <div class="entry-content">
    		<?php
    			/* translators: %s: Name of current post */
    			the_content( sprintf(
    				__( 'Continue reading %s', 'twentyfifteen' ),
    				the_title( '<span class="screen-reader-text">', '</span>', false )
    			) );

    			wp_link_pages( array(
    				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
    				'after'       => '</div>',
    				'link_before' => '<span>',
    				'link_after'  => '</span>',
    				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
    				'separator'   => '<span class="screen-reader-text">, </span>',
    			) );
    		?>
      </div>
    	</div><!-- .entry-content -->


<?php
		// End the loop.
		endwhile;

?>

</article><!-- #post-## -->

</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
