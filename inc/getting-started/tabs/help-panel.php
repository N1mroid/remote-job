<?php
/**
 * Help Panel.
 *
 * @package JobScout_Pro
 */
?>
<!-- Help file panel -->
<div id="help-panel" class="panel-left">
    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Documentation Link', 'jobscout-pro' ); ?></h4>
        <p><?php esc_html_e( 'Are you new to WordPress? Our extensive documentation has step by step guide to create an attractive website.', 'jobscout-pro' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/jobscout-pro/' ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'jobscout-pro' ); ?>" target="_blank">
            <?php esc_html_e( 'View Documentation', 'jobscout-pro' ); ?>
        </a>
    </div><!-- .panel-aside -->
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'Support Ticket', 'jobscout-pro' ); ?></h4>
        <p><?php printf( __( 'It\'s always a good idea to visit our %1$sKnowledge Base%2$s before you send us a support ticket.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://docs.rarathemes.com/docs/jobscout-pro/' ) .'" target="_blank">', '</a>' ); ?></p>
        <p><?php printf( __( 'If the Knowledge Base didn\'t answer your queries, submit us a %1$sSupport Ticket%2$s here. Our response time usually is less than a business day, except on the weekends.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://rarathemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/support-ticket/' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'jobscout-pro' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'jobscout-pro' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our JobScout Pro Demo', 'jobscout-pro' ); ?></h4>
        <p><?php esc_html_e( 'Visit the demo of our theme to get more ideas about the design and layout of our theme.', 'jobscout-pro' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/previews/?theme=jobscout-pro' ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'jobscout-pro' ); ?>" target="_blank">
            <?php esc_html_e( 'View Demo', 'jobscout-pro' ); ?>
        </a>
    </div><!-- .panel-aside -->
</div>