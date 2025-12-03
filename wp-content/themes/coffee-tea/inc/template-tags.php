<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Coffee Tea
 */

if ( ! function_exists( 'coffee_tea_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function coffee_tea_posted_on() {
	$coffee_tea_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$coffee_tea_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$coffee_tea_time_string = sprintf( $coffee_tea_time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$coffee_tea_posted_on = sprintf(
		/* translators: %s: Posted on. */
		esc_html_x( 'Posted on %s', 'post date', 'coffee-tea' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $coffee_tea_time_string . '</a>'
	);

	$coffee_tea_byline = sprintf(
		/* translators: %s: by. */
		esc_html_x( 'by %s', 'post author', 'coffee-tea' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on">' . $coffee_tea_posted_on . '</span><span class="byline"> ' . $coffee_tea_byline . '</span>'; // WPCS: XSS OK.
}
endif;


if ( ! function_exists( 'coffee_tea_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function coffee_tea_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$coffee_tea_categories_list = get_the_category_list( esc_html__( ', ', 'coffee-tea' ) );
		if ( $coffee_tea_categories_list && coffee_tea_categorized_blog() ) {
			/* translators: %s: Posted in. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'coffee-tea' ) . '</span>', $coffee_tea_categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$coffee_tea_tags_list = get_the_tag_list( '', esc_html__( ', ', 'coffee-tea' ) );
		if ( $coffee_tea_tags_list ) {
			/* translators: %s: Tagged on. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'coffee-tea' ) . '</span>', $coffee_tea_tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'coffee-tea' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'coffee-tea' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function coffee_tea_categorized_blog() {
	if ( false === ( $coffee_tea_all_the_cool_cats = get_transient( 'coffee_tea_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$coffee_tea_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$coffee_tea_all_the_cool_cats = count( $coffee_tea_all_the_cool_cats );

		set_transient( 'coffee_tea_categories', $coffee_tea_all_the_cool_cats );
	}

	if ( $coffee_tea_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so coffee_tea_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so coffee_tea_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in coffee_tea_categorized_blog.
 */
function coffee_tea_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'coffee_tea_categories' );
}
add_action( 'edit_category', 'coffee_tea_category_transient_flusher' );
add_action( 'save_post',     'coffee_tea_category_transient_flusher' );

/**
 * Register Google fonts.
 */
function coffee_tea_google_font() {
	$coffee_tea_font_url      = '';
	$coffee_tea_font_family   = array(
		'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
		'Fredericka the Great',
		'Pacifico'
	);
	
	$coffee_tea_fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $coffee_tea_font_family ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	$coffee_tea_contents = wptt_get_webfont_url( esc_url_raw( $coffee_tea_fonts_url ) );
	return $coffee_tea_contents;
}

function coffee_tea_scripts_styles() {
    wp_enqueue_style( 'coffee-tea-fonts', coffee_tea_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'coffee_tea_scripts_styles' );

/**
 * Register Breadcrumb for Multiple Variation
 */
function coffee_tea_breadcrumbs_style() {
	get_template_part('./template-parts/sections/section','breadcrumb');
}

/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'coffee_tea_post_layout' )) :
function coffee_tea_post_layout(){
	if(is_active_sidebar('coffee-tea-sidebar-primary'))
		{ echo 'col-lg-8'; } 
	else 
		{ echo 'col-lg-12'; }  
} endif;