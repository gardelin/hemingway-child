<?php global $post; ?>
<?php if (in_array(strtolower($post->post_title), ['naslovna', 'o klubu'])) : ?>
    <div class="section-inner">
        <h3 class="sponsors-title"><?php _e('Sponsors', 'hemingway'); ?></h3>

        <div class="sponsors">
            <?php dynamic_sidebar('sponsors'); ?>
        </div>
    </div>

    <div class="section-inner">
        <h3 class="patrons-title"><?php _e('Patrons', 'hemingway'); ?></h3>

        <div class="patrons">
            <?php dynamic_sidebar('patrons'); ?>
        </div>
    </div>
<?php endif; ?>

<div class="footer section large-padding bg-dark">

    <div class="footer-inner section-inner group">

        <?php if (is_active_sidebar('footer-a')) : ?>

            <div class="column column-1 left">

                <div class="widgets">

                    <?php dynamic_sidebar('footer-a'); ?>

                </div>

            </div>

        <?php endif; ?>
        <!-- .footer-a -->

        <?php if (is_active_sidebar('footer-b')) : ?>

            <div class="column column-2 left">

                <div class="widgets">

                    <?php dynamic_sidebar('footer-b'); ?>

                </div><!-- .widgets -->

            </div>

        <?php endif; ?>
        <!-- .footer-b -->

        <?php if (is_active_sidebar('footer-c')) : ?>

            <div class="column column-3 left">

                <div class="widgets">

                    <?php dynamic_sidebar('footer-c'); ?>

                </div><!-- .widgets -->

            </div>

        <?php endif; ?>
        <!-- .footer-c -->

    </div><!-- .footer-inner -->

</div><!-- .footer -->

<div class="credits section bg-dark no-padding">

    <div class="credits-inner section-inner group">

        <p class="credits-left">
            &copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
        </p>

        <p class="credits-right">
            <a href="https://www.facebook.com/SPK-Vertikal-367776523240040/" title="<?php _e('Facebook', 'hemingway'); ?>" target="_blank" class="icon-facebook"></a>
            <a href="https://www.youtube.com/user/pkvertikal" title="<?php _e('Youtube', 'hemingway'); ?>" target="_blank" class="icon-youtube"></a>
            <a title="<?php _e('To the top', 'hemingway'); ?>" class="icon-up-big tothetop"></a>
        </p>

    </div><!-- .credits-inner -->

</div><!-- .credits -->

</div><!-- .big-wrapper -->

<?php wp_footer(); ?>

</body>

</html>