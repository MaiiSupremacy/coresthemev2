<?php
/**
 * The template for displaying comments
 *
 * Matches CORES Theme Glassmorphism style.
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area fade-in" style="margin-top: 4rem; padding-top: 3rem; border-top: 1px solid var(--medium-gray);">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title" style="color: var(--primary); font-size: 1.8rem; margin-bottom: 2rem;">
            <?php
            $cores_comment_count = get_comments_number();
            if ( '1' === $cores_comment_count ) {
                printf( esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'cores-theme' ), '<span>' . get_the_title() . '</span>' );
            } else {
                printf( 
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $cores_comment_count, 'comments title', 'cores-theme' ) ),
                    number_format_i18n( $cores_comment_count ),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'cores_comment_callback' // We can define this in functions.php or let WP handle basics, but let's style the wrapper via CSS
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note.
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cores-theme' ); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().
    ?>

    <?php
    $comment_args = array(
        'title_reply'       => __( 'Leave a Reply', 'cores-theme' ),
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title" style="color: var(--primary); margin-bottom: 1rem;">',
        'title_reply_after'  => '</h3>',
        'class_submit'      => 'cta-button',
        'label_submit'      => __( 'Post Comment', 'cores-theme' ),
        'comment_field'     => '<p class="comment-form-comment"><label for="comment" class="screen-reader-text">' . _x( 'Comment', 'noun', 'cores-theme' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__( 'Your Comment...', 'cores-theme' ) . '" required style="width: 100%; padding: 1rem; border-radius: 15px; border: 2px solid var(--medium-gray); background: var(--white); font-family: inherit;"></textarea></p>',
    );
    
    comment_form( $comment_args );
    ?>

</div><!-- #comments -->
