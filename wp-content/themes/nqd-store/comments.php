<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to nqd_store_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package NQD Store
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( '1 bình luận', '%1$s bình luận', get_comments_number(), 'comments title', 'nqd-store' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'nqd-store' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'nqd-store' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'nqd-store' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use nqd_store_comment() to format the comments.
				 * If you want to override this in a child theme then you can
				 * define nqd_store_comment() and that will be used instead.
				 * See nqd_store_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'nqd_store_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'nqd-store' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'nqd-store' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'nqd-store' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'nqd-store' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<p class="comment-form-author">'.
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="Nhập tên thật của bạn" ' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email">'.
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="Nhập email của bạn" ' . $aria_req . ' /></p>',
			'url'  => '<p class="comment-form-url"><label for="url">'.
				'<input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" placeholder="Nhập link website của bạn"' . $aria_req . ' /></p>',
		);
		 
		$comments_args = array(
			'fields' =>  $fields,
			'title_reply'=>'Gửi bình luận',
			'label_submit' => 'Gửi bình luận',
			'comment_notes_after' => ' ',
			'comment_notes_before'=> ''
		);
		comment_form($comments_args);
	?>

</div><!-- #comments -->
