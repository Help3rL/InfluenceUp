<?php
/**
 * @var string  $phone
 * @var string  $whatsapp_number
 * @var string  $email
 * @var string  $website
 * @var array   $phone_options
 * @var bool    $has_contact_form
 * @var string  $email_to_seller_form
 * @var Listing $listing
 * @var array   $locations
 * @var int     $listing_id Listing id
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use radiustheme\CLDirectory\Helper;
use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;
use RtclPro\Helpers\Fns;
use \radiustheme\CLDirectory\RDTheme;

global $listing;
$phone                      = get_post_meta( $listing->get_id(), 'phone', true );
$whatsapp                   = get_post_meta( $listing->get_id(), '_rtcl_whatsapp_number', true );
$email                      = get_post_meta( $listing->get_id(), 'email', true );
$address                    = get_post_meta( $listing->get_id(), 'address', true );
$website                    = get_post_meta( $listing->get_id(), 'website', true );
$rating_count               = $listing->get_rating_count();
$average_rating             = $listing->get_average_rating();
$listing_owner_widget_title = RDTheme::$options['listing_owner_widget_title'];
$user_login_class=is_user_logged_in() ? 'has-chat':'no-chat';
?>

<div class="rtcl-listing-user-info widget <?php echo esc_attr($user_login_class); ?>">
	<?php if ( $phone || $email || $website || $whatsapp ) : ?>
        <div class="widget-contact-form">
            <?php if(RDTheme::$options['show_owner_store_title']){ ?>
                <h3 class="listing-entry-inner-title">
                    <?php
                    if ( $listing_owner_widget_title) {
                        echo esc_html( $listing_owner_widget_title );
                    } else {
                        echo esc_html__( "Listing Information", 'cldirectory' );
                    }
                    ?>
                </h3>
            <?php } ?>
            <div class="rtcl-member-info-wrapper">
                <div class="member-header">
                    <div class="member-img">
                        <a  href="<?php echo method_exists( $listing, 'get_the_author_url' ) ? esc_url( $listing->get_the_author_url() ) : '#';?>">
                            <?php Helper::get_listing_author_image( $listing,105 ); ?>
                        </a>
                        <?php
                            $status = apply_filters( 'rtcl_user_offline_text', esc_html__( 'Offline Now', 'cldirectory' ) );
                            if ( Fns::is_online( $listing->get_owner_id() ) ) {
                                $status = apply_filters( 'rtcl_user_online_text', esc_html__( 'Online Now', 'cldirectory' ) );
                            }
						  ?>
                          
                    </div>
                    <div class="member-title">
                        <h4>
                            <a href="<?php echo method_exists( $listing, 'get_the_author_url' ) ? esc_url( $listing->get_the_author_url() ) : '#';?>">
                                <?php echo esc_html( $listing->get_author_name() ); ?>
                            </a>
                        </h4>
                        <div class="rtin-box-item cldirectory-user-status <?php echo esc_attr( strtolower( $status ) ); ?>">
							<span><?php echo esc_html( $status ); ?></span>
						</div>
                    </div>
                </div>
                <div class="member-content">
                    <ul class="store-meta">
                        <?php if (Fns::registered_user_only('listing_seller_information') && !is_user_logged_in()) { ?>
                            <p class="login-message"><?php echo wp_kses(sprintf(__("Please <a href='%s'>login</a> to view the seller information.", "cldirectory"), esc_url(Link::get_my_account_page_link())), ['a' => ['href' => []]]); ?></p>
                        <?php } else { ?>
                            <?php if($address): ?>
                            <li class="listing-location">
                                <span><i class="map-marker-cl-icon"></i><?php echo esc_html($address); ?></span>
                            </li>
                            <?php endif;?>
                            <?php if ( $phone ) : ?>
                                <li class="item-number phone">
                                    <a target="_blank" href="tel:<?php echo esc_attr( $phone ); ?>">
                                        <i class="phone-call-cl-icon"></i><?php echo esc_html( $phone ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ( $whatsapp && RDTheme::$options['show_owner_store_whatsapp']) : ?>
                                <li class="item-number  whatsapp">
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo esc_attr( $whatsapp ); ?>&text=<?php echo get_the_title();?>">
                                        <i class="fa-brands fa-whatsapp"></i><?php echo esc_html( $whatsapp ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ( $email && RDTheme::$options['show_owner_store_email']) : ?>
                                <li class="store-email listing-mail">
                                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><i class="envelope-cl-icon"></i><?php echo esc_html( $email ); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($website && RDTheme::$options['show_owner_store_website']): ?>
                                <li class="store-website listing-website">
                                    <a href="<?php echo esc_url( $website ); ?>"><i class="globe-cl-icon"></i><?php echo esc_html__('Visit Website','cldirectory'); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (Fns::registered_user_only('listing_seller_information') && !is_user_logged_in()) { } else {?>
                                <?php if(is_user_logged_in()){ ?>
                                    <li class="rtcl-chat-website-link">
                                        <?php
                                        if ( Fns::is_enable_chat() && is_user_logged_in() ):
                                            $chat_btn_class = [ 'rtcl-chat-link' ];
                                            $chat_url = Link::get_my_account_page_link('chat');
                                            $is_chat = 'rtcl-contact-link';
                                            $chat_label = 'Live Chat';
                                            if ( is_user_logged_in() && $listing->get_author_id() !== get_current_user_id() ) {
                                                $chat_url   = '#';
                                                $chat_label = __('Quick Chat','cldirectory');
                                                $is_chat    = 'rtcl-contact-seller';
                                                array_push( $chat_btn_class, 'rtcl-contact-seller' );
                                            }
                                            ?>
                                            <span class='<?php echo esc_attr( $is_chat ); ?>'>
                                                <a class="<?php echo esc_attr( implode( ' ', $chat_btn_class ) ) ?>"
                                                href="<?php echo esc_url( $chat_url ) ?>" data-listing_id="<?php the_ID() ?>">
                                                    <i class="reply-cl-icon"></i><?php echo esc_html($chat_label ); ?>
                                                    <span class="rtcl-chat-unread-count"></span>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    </li>
                                <?php } ?>
	                        <?php } ?>
                        <?php } ?>
                    </ul>
                    <?php do_action( 'rtcl_single_listing_social_profiles' ); ?>
                </div>
            </div>
        </div>
	<?php endif; ?>
</div>