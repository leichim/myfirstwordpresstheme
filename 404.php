<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
get_header(); ?>
    <main id="content" role="main">
        <article id="post-0" class="post error404 not-found largebox">
            <div class="post-content">
                <div itemprop="description">
                    <p style="margin-top:7em;"><?php _e( 'In understandable language: the page you requested could not be found. Perhaps try searching?', 'msign' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </div><!-- .post-content -->
        </article><!-- #post-0 -->
    </main><!-- #content -->
<?php get_footer(); ?>