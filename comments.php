<?php
/**
 * The template for displaying Comments.
 */
?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'msign' ); ?></p>
</div><!-- #comments -->
<?php return; endif;
    if ( have_comments() ) : ?>
        <h3 id="comments-title"><?php
        printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'msign' ),
        number_format_i18n( get_comments_number() ), '<a href="#comments-title">' . get_the_title() . '</a>' );
        ?></h3>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'msign' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'msign' ) ); ?></div>
        </div> <!-- .navigation -->
    <?php endif;  ?>
        <ol class="commentlist">
            <?php
                wp_list_comments( array( 'callback' => 'msign_comment' ) );
            ?>
        </ol>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
        <nav class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'msign' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'msign' ) ); ?></div>
        </nav><!-- .navigation -->
    <?php endif; else : 
    if ( ! comments_open() ) :?>
    <p class="nocomments"><?php _e( 'Comments are closed.', 'msign' ); ?></p>
<?php endif;  endif;  comment_form(); ?>
</div><!-- #comments -->