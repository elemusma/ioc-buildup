<?php
/**
 * Gravity Forms Stripe Payment Element Intents manager.
 *
 * This class acts as a wrapper for all the logic required to create and update the payment element intents depending on different feed settings.
 *
 * @since     5.0
 * @package   GravityForms
 * @author    Rocketgenius
 * @copyright Copyright (c) 2021, Rocketgenius
 */
class GF_Payment_Element_Payment {

	/**
	 * Instance of a GFStripe object.
	 *
	 * @since 5.0
	 *
	 * @var GFStripe
	 */
	protected $addon;

	/**
	 * The currency used in the current transaction.
	 *
	 * @since 5.0
	 *
	 * @var string
	 */
	protected $currency;

	/**
	 * The id of the payment intent being processed.
	 *
	 * @since 5.0
	 *
	 * @var string
	 */
	public $intent_id;

	/**
	 * The id of the invoice, used only for subscriptions with `send-invoice` collection method.
	 *
	 * @since 5.0
	 *
	 * @var string
	 */
	public $invoice_id;


	/**
	 * GF_Stripe_Payment_Element_Intent constructor.
	 *
	 * @since 5.0
	 *
	 * @param GFStripe $addon Instance of a GFStripe object.
	 */
	public function __construct( $addon ) {
		$this->addon    = $addon;
		$this->currency = GFCommon::get_currency();
	}

	/**
	 * Returns a list of the payment methods available to be used in the payment element.
	 *
	 * If this filter returns an empty list, automatic payment methods will be used.
	 *
	 * @since 5.0
	 *
	 * @param array $feed The current feed object being processed.
	 * @param array $form The current form object being processed.
	 *
	 * @return array
	 */
	public function get_payment_methods( $feed, $form ) {
		/**
		 * Allow Manually setting the payment methods used by the payment element.
		 *
		 * @since  5.0
		 *
		 * @param array $payment_methods An array of payment methods to be used.
		 * @param array $feed The feed currently being processed.
		 * @param array $form The form which created the current entry.
		 */
		$methods = apply_filters( 'gform_stripe_payment_element_payment_methods', array(), $feed, $form );

		if ( ! empty( $methods ) ) {
			$this->addon->log_debug( __METHOD__ . '() - Payment methods filter is being used, feed type is: ' . $feed['meta']['transactionType'] . ',  payment methods: ' . print_r( $methods, true ) );
		}

		return $methods;
	}

	/**
	 * Returns a list of payment methods that use automatic charge as collection method.
	 *
	 *
	 * @since 5.0
	 *
	 * @param array $feed  The current feed object being processed.
	 * @param array $form  The current form object being processed.
	 *
	 * @return array
	 */
	public function get_subscriptions_automatic_charge_methods( $feed, $form ) {
		$methods = array(
			'card',
			'sepa_debit',
			'bancontact',
			'eps',
			'ideal',
			'us_bank_account',
			'link',
			'bacs_debit',
			'boleto',
			'fpx',
			'au_becs_debit',
			'acss_debit'
		);
		/**
		 * Get a list of ist of the payment methods that use automatic charge as collection method.
		 *
		 * @since  5.0
		 *
		 * @param array $mthods An array of payment methods to be used.
		 * @param array $feed   The feed currently being processed.
		 * @param array $form   The form which created the current entry.
		 */
		return apply_filters( 'gform_stripe_payment_element_subscriptions_automatic_charge_methods', $methods, $feed, $form );
	}

	/**
	 * Created an intent after front end validation.
	 *
	 * @since 5.0
	 *
	 * @param array         $order_data The order data exctracted from the user's submission.
	 * @param int           $feed_id    The id of the feed being processed.
	 * @param int           $form_id    The id of the form being processed.
	 * @param GF_Stripe_API $api        The stripe API instance used to communicate with the stripe API.
	 * @param array         $entry      If the entry is already created, pass it on.
	 *
	 * @return \Stripe\PaymentIntent|\Stripe\SetupIntent|WP_Error
	 */
	public function create_payment_intent( $order_data, $feed_id, $form_id, $api, $entry = null ) {
		$feed = $this->addon->get_feed( $feed_id );
		$form = GFAPI::get_form( $form_id );

		if ( $entry === null ) {
			$temp_entry = isset( $order_data['temp_lead'] ) ? $order_data['temp_lead'] : $order_data;
		} else {
			$temp_entry = $entry;
		}

		$intent_meta     = array();
		$amount          = rgar( $order_data, 'total', 0 );
		$payment_methods = $this->get_payment_methods( $feed, $form );
		if ( ! empty( $payment_methods ) ) {
			// When payment method types are explicitly defined, 'card' must be one of the methods.
			$payment_methods                     = array_unique( array_merge( $payment_methods, array( 'card' ) ) );
			$intent_meta['payment_method_types'] = $payment_methods;
		} else {
			$intent_meta['automatic_payment_methods'] = array( 'enabled' => true );
		}
		$intent_meta['description'] = $this->addon->get_payment_description(
			$temp_entry,
			$order_data,
			$this->addon->get_feed( $feed_id )
		);

		$intent_meta['customer']       = $this->get_customer( $feed, $form, $api, $temp_entry );
		$intent_meta['amount']         = $this->addon->get_amount_export( $amount, $this->currency );
		$intent_meta['currency']       = strtolower( $this->currency );
		$intent_meta['capture_method'] = $this->addon->get_payment_element_capture_method( $form, $feed );

		// Run intent meta through product payment data filter.
		$intent_meta = $this->addon->get_product_payment_data( $intent_meta, $feed, $order_data, $form, $temp_entry );

		// Add link token if it exists to show saved payment details.
		$link_token = sanitize_text_field( rgar( $_COOKIE, 'gf_stripe_token' ) );
		if ( $link_token ) {
			$intent_meta['payment_method_options'] = array(
				'link' => array(
					'persistent_token' => $link_token,
				),
			);
		}

		$this->addon->log_debug( __METHOD__ . '(): Creating intent with meta: ' . print_r( $intent_meta, true ) );

		return $api->create_payment_intent( $intent_meta );
	}

	/**
	 * Creates a subscription.
	 *
	 * @since 5.0
	 *
	 * @param array         $order_data The submitted order information.
	 * @param int           $feed_id    The current feed id.
	 * @param int           $form_id    The current form id.
	 * @param GF_Stripe_API $api        An instance of the Stripe API.
	 * @param null|array    $entry      If the entry has been already created before, pass it on.
	 *
	 * @return \Stripe\Subscription|WP_Error
	 */
	public function create_subscription( $order_data, $feed_id, $form_id, $api, $entry = null ) {

		if ( $entry === null ) {
			$temp_entry = isset( $order_data['temp_lead'] ) ? $order_data['temp_lead'] : $order_data;
		} else {
			$temp_entry = $entry;
		}

		$feed           = $this->addon->get_feed( $feed_id );
		$form           = GFAPI::get_form( $form_id );
		$currency       = rgar( $temp_entry, 'currency' );
		$plan           = $this->addon->get_plan_for_feed( $feed, $order_data['total'], $order_data['trial_days'], $currency );
		$customer       = $this->get_customer( $feed, $form, $api, $temp_entry );
		$payment_method = rgar( $order_data, 'payment_method' );
		if ( rgar( $order_data, 'setup_fee' ) ) {
			// If a setup fee is required, add an invoice item.
			$setup_fee = array(
				'amount'      => $this->addon->get_amount_export( $order_data['setup_fee'], $currency ),
				'currency'    => $currency,
				'customer'    => $customer,
				'description' => __( 'Setup Fee', 'gravityformsstripe' ),
			);

			$result = $api->add_invoice_item( $setup_fee );
		}

		$subscription_data = array(
			'description'      => $this->addon->get_payment_description( $temp_entry, $order_data['submission'], $feed ),
			'customer'         => $customer,
			'items'            => array(
				array(
					'plan' => $plan->id,
				),
			),
			'payment_behavior' => 'default_incomplete',
			'payment_settings' => array( 'save_default_payment_method' => 'on_subscription' ),
			'expand'           => array( 'latest_invoice.payment_intent' ),
		);

		// Some payment methods work by sending an invoice to the customer and not charging automatically.
		$automatic_charge_methods = $this->get_subscriptions_automatic_charge_methods( $feed, $form );
		if ( ! in_array( $payment_method, $automatic_charge_methods ) ) {
			$subscription_data['collection_method'] = 'send_invoice';
			$subscription_data['days_until_due']    = 1;
		}

		$payment_methods = $this->get_payment_methods( $feed, $form );
		if ( ! empty( $payment_methods ) ) {
			// When payment method types are explicitly defined, 'card' must be one of the methods.
			$payment_methods                                               = array_unique( array_merge( $payment_methods, array( 'card' ) ) );
			$subscription_data['payment_settings']['payment_method_types'] = $payment_methods;
		} else {
			$subscription_data['payment_settings']['payment_method_types'] = array();
		}

		if ( $order_data['trial_days'] > 0 ) {
			$subscription_data['trial_from_plan'] = true;
		}

		// Run the subscription through the filters used by the Stripe Add-On.
		$subscription_data = $this->addon->get_subscription_params( $subscription_data, $customer, $plan, $feed, $temp_entry, $form, $order_data['trial_days'] );

		return $api->create_subscription( $subscription_data );
	}

	/**
	 * Creates or gets a customer.
	 *
	 * @since 5.0
	 *
	 * @param array         $feed  The current feed being processed.
	 * @param array         $form  The current form being processed.
	 * @param GF_Stripe_API $api   An instance of the Stripe API.
	 * @param array         $entry The current entry being processed.
	 *
	 * @return \Stripe\Customer
	 */
	public function get_customer( $feed, $form, $api, $entry ) {

		$customer_meta = array(
			'description' => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'customerInformation_description' ) ),
			'email'       => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'customerInformation_email' ) ),
			'name'        => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'customerInformation_name' ) ),
			'address'     => array(
				'city'        => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_city' ) ),
				'country'     => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_country' ) ),
				'line1'       => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_line1' ) ),
				'line1'       => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_line1' ) ),
				'line2'       => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_line2' ) ),
				'postal_code' => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_zip' ) ),
				'state'       => $this->addon->get_field_value( $form, $entry, rgar( $feed['meta'], 'billingInformation_address_state' ) ),
			),
		);
		// Get coupon for feed.
		$coupon_field_id = rgar( $feed['meta'], 'customerInformation_coupon' );
		$coupon          = $this->addon->maybe_override_field_value( rgar( $entry, $coupon_field_id ), $form, $entry, $coupon_field_id );

		// If coupon is set, add it to customer metadata.
		if ( $coupon ) {
			$stripe_coupon = $api->get_coupon( $coupon );
			if ( ! is_wp_error( $stripe_coupon ) ) {
				$customer_meta['coupon'] = $coupon;
			} else {
				$this->addon->log_error( __METHOD__ . '(): Unable to add the coupon to the customer; ' . $stripe_coupon->get_error_message() );
			}
		}

		$customer = $this->addon->get_customer( '', $feed, $entry, $form );

		if ( $customer ) {
			$api->update_customer( $customer->id, $customer_meta );
		} else {
			$customer = $this->addon->create_customer( $customer_meta, $feed, $entry, $form );
		}

		if ( is_wp_error( $customer ) ) {
			$customer = $api->create_customer( array() );
		}

		return $customer;
	}

	/**
	 * Calculates the discount amount a stripe coupon can apply to the total of an order.
	 *
	 * @since 5.0
	 *
	 * @param double         $order_total   The order total.
	 * @param \Stripe\Coupon $stripe_coupon The stripe coupon.
	 *
	 * @return float|int
	 */
	public function get_coupon_discount( $order_total, \Stripe\Coupon $stripe_coupon ) {
		if ( ! $stripe_coupon->valid ) {
			return 0;
		}

		if ( $stripe_coupon->amount !== null ) {
			return $this->addon->get_amount_import( $stripe_coupon->amount, $this->currency );
		}

		if ( $stripe_coupon->percent_off !== null ) {
			return ( $order_total * $stripe_coupon->percent_off ) / 100;
		}

		return 0;
	}

	/**
	 * Retrieves a payment intent, a setup intent or an invoice for the current payment.
	 *
	 * @since 5.0
	 *
	 * @param array         $feed The current feed being processed.
	 * @param string        $id   The ID of the intent.
	 * @param GF_Stripe_API $api  The stripe API instance used to communicate with the stripe API.
	 *
	 * @return \Stripe\PaymentIntent|\Stripe\SetupIntent|\Stripe\Invoice|WP_Error
	 */
	public function get_stripe_payment_object( $feed, $id, $api ) {
		if ( strpos( $id, 'in' ) === 0 ) {
			return $api->get_invoice( $id );
		}

		if ( rgars( $feed, 'meta/trial_enabled' ) && ! rgars( $feed, 'meta/setupFee_enabled' ) ) {
			return $api->get_setup_intent( $id, array( 'expand' => array( 'payment_method' ) ) );
		} else {
			return $api->get_payment_intent( $id, array( 'expand' => array( 'payment_method', 'invoice' ) ) );
		}
	}

	public function get_subscription_intent( $subscription, $feed, $api ) {
		$intent_id       = null;
		$subscription_id = $subscription->id;

		if ( $subscription['collection_method'] === 'send_invoice' ) {
			$invoice = $subscription->latest_invoice;
			$invoice = $api->finalize_invoice( $invoice->id );

			if ( ! rgars( $feed, 'meta/trial_enabled' ) || rgars( $feed, 'meta/setupFee_enabled' ) ) {
				$intent = $this->get_stripe_payment_object( $feed, $invoice->payment_intent, $api );
			} else {
				return null;
			}
		} else {
			if ( ! rgars( $feed, 'meta/trial_enabled' ) || rgars( $feed, 'meta/setupFee_enabled' ) ) {
				$intent_id = $subscription->latest_invoice->payment_intent->id;
			} else {
				$intent_id = $subscription->pending_setup_intent;
			}

			$intent = $this->get_stripe_payment_object( $feed, $intent_id, $api );
		}

		return $intent;
	}
}
