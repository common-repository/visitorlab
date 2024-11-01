<?php

    // No direct access to this file
    defined( 'ABSPATH' ) or die();

?>

<?php if ( isset( $_GET['settings-updated'] ) ) : ?>

    <?php if ( get_option('VisitorLAB_script') == '' ): ?>
        <div id="message" class="notice notice-warning is-dismissible">
            <p><strong><?php _e('Paste your VisitorLAB tracking code for activation.', 'visitorlab'); ?></strong></p>
        </div>
    <?php else: ?>
        <div id="message" class="notice notice-success is-dismissible">
            <p><strong><?php echo 'VisitorLAB tracking code is activated' ?></strong></p>
        </div>
    <?php endif; ?>

<?php endif; ?>


<div class="tab-content" style="margin-top:10px;">
    <div id="tab-1" class="tab-pane active">

    <div id="content-wrap" class="wrap">

        <div class="wp-header">
            <img src="<?php echo plugins_url( '../static/icon.png', __FILE__ ); ?>" alt="VisitorLAB" class="visitorlab-logo">
        </div>

        <form method="post" action="options.php">
            <?php settings_fields( 'visitorlab' );
            do_settings_sections('visitorlab'); ?>

            <div id="visitorlab-form-area">
                <p><?php
                    $url = 'https://app.visitorlab.com/hello';
                    $link = sprintf( wp_kses( __( 'Get your tracking code from <a href="%s" target="_blank">here</a>', 'visitorlab'), array(  'a' => array( 'href' => array(), 'target' =>  '_blank' ) ) ), esc_url( $url ) );
                    echo $link;
                ?>

                <br/>

                <?php
                    $url = 'https://app.visitorlab.com/register';
                    $link = sprintf( wp_kses( __( "Still dont have an account? Come <a href='%s' target='_blank'>here</a>  and let's start your free trial.", 'visitorlab'), array(  'a' => array( 'href' => array(), 'target' =>  '_blank' ) ) ), esc_url( $url ) );
                    echo $link;
                ?>
                </p>

                <p>
                    <?php _e('Paste your VisitorLAB tracking code into the text area below for connecting VisitorLAB to your WordPress website, Then enjoy the understanding of your visitor.', 'visitorlab'); ?>
                </p>

                <table class="form-table">
                    <tbody>
                        <tr>
                        <th scope="row">
                            <label for="visitorlab_script"><?php esc_html_e( 'VisitorLAB tracking code', 'visitorlab'); ?></label>
                        </th>
                            <td>
                                <textarea class="regular-text" rows="4" name="visitorlab_script" id="visitorlab_script"><?php echo esc_attr( get_option('visitorlab_script') ); ?></textarea>
                                <p id="wp_visitorlab_script_description">
                                    <small>
                                        If you need more info write to us <a target="_blank" href="mailto:support@visitorlab.com">support@visitorlab.com</a>
                                    </small>
                                </p> 
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <?php submit_button(); ?>

        </form>
    </div>
</div>

</div>