<?php
/**
 *
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 *
 * @var WP_Query $rtcl_query
 */

use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;
use Rtcl\Helpers\Pagination;
use RtclInvoice\Helpers\Functions as InvoiceFunctions;

global $post;

$nonceId = wp_create_nonce( rtcl()->nonceText );
?>
<div class="rtcl-payment-history-wrap">
	<?php
	if ( $rtcl_query->have_posts() ) {

		?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php esc_html_e( '#', 'rtcl-invoices' ); ?></th>
                    <th><?php esc_html_e( 'Total', 'rtcl-invoices' ); ?></th>
                    <th><?php esc_html_e( 'Status', 'rtcl-invoices' ); ?></th>
                    <th><?php esc_html_e( 'Date', 'rtcl-invoices' ); ?></th>
                    <th><?php esc_html_e( 'Invoice', 'rtcl-invoices' ); ?></th>
                </tr>
                </thead>
                <!-- the loop -->
				<?php while ( $rtcl_query->have_posts() ) : $rtcl_query->the_post();
					$order = rtcl()->factory->get_order( get_the_ID() ); ?>
                    <tr>
                        <td><?php printf( '<a href="%s">%s</a>', Link::get_checkout_endpoint_url( "payment-receipt", $order->get_id() ),
								$order->get_maybe_id() ) ?></td>
                        <td><?php
							$title            = $order->get_payment_method_title();
							$main_amount_html = Functions::get_payment_formatted_price_html( $order->get_total() );
							$main_amount      = apply_filters( 'rtcl_payment_table_total_amount', $main_amount_html, $order );
							printf( "%s<br><small class='meta'>%s</small>", $main_amount,
								$order->get_total() === 0 ? $title : sprintf( __( 'Pay via <strong>%s</strong>', 'rtcl-invoices' ), $title )
							);
							?></td>
                        <td><?php echo Functions::get_status_i18n( $post->post_status ); ?></td>
                        <td><?php echo Functions::datetime( 'rtcl', $post->post_date_gmt ); ?></td>
                        <td>
                            <a href="<?php echo esc_url( InvoiceFunctions::get_pdf_download_file() ); ?>?order_id=<?php echo absint( get_the_ID() ); ?>&__rtcl_wpnonce=<?php echo esc_attr( $nonceId ); ?>"
                               class="invoice-download-btn">
								<?php esc_html_e( 'Download', 'rtcl-invoices' ); ?>
                            </a>
                        </td>
                    </tr>
				<?php endwhile;
				wp_reset_postdata();
				?>
            </table>
        </div>
        <!-- pagination here -->
		<?php
		Pagination::pagination( $rtcl_query );

	} else {
		echo '<span>' . __( 'No Results Found.', 'rtcl-invoices' ) . '</span>';
	} ?>
</div>
