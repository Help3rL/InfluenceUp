<?php
/**
 * new listing email notification to owner
 * This template can be overridden by copying it to yourtheme/classified-listing/emails/new-post-notification-user.php
 *
 * @var RtclEmail $email
 * @var array     $data
 * @var Listing   $listing
 * @author        RadiusTheme
 * @package       ClassifiedListing/Templates/Emails
 * @version       1.3.0
 *
 */

use Rtcl\Models\Listing;
use Rtcl\Models\RtclEmail;
use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked RtclEmails::email_header() Output the email header
 */
do_action( 'rtcl_email_header', $email ); ?>
    <p><?php _e( 'Hi Administrator,', 'cldirectory' ); ?></p>
    <p><?php printf( __( 'A listing on your website %s received a message.', 'cldirectory' ), Functions::get_blogname() ) ?></p>
    <p><?php printf( __( '<strong>Listing :</strong> <a href="%s">%s</a>', 'cldirectory' ), $listing->get_the_permalink(), $listing->get_the_title() ); ?></p>
    <p><?php printf( __( '<strong>Sender name:</strong> %s', 'cldirectory' ), $data['name'] ); ?></p>
    <p><?php printf( __( '<strong>Sender email:</strong> %s', 'cldirectory' ), $data['email'] ); ?></p>
    <p><?php printf( __( '<strong>Sender phone:</strong> %s', 'cldirectory' ), $data['phone'] ); ?></p>
    <p><?php printf( __( '<strong>Sender message:</strong> %s', 'cldirectory' ), $data['message'] ); ?></p>
<?php

/**
 * @hooked RtclEmails::email_footer() Output the email footer
 */
do_action( 'rtcl_email_footer', $email );
