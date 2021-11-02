<?php
/**
 * The Event Status Labels.
 *
 * @package Tribe\Events\Event_Status
 * @since   TBD
 */

namespace Tribe\Events\Event_Status;

use WP_Post;

/**
 * Class Statuses
 *
 * @since   TBD
 *
 * @package Tribe\Events\Event_Status
 */
class Status_Labels {

	/**
	 * Add the event statuses to select for an event.
	 *
	 * @since TBD
	 *
	 * @param array<string|mixed> $statuses The event status options for an event.
	 * @param WP_Post $event The event post object.
	 *
	 * @return array<string|mixed> The event status options for an event.
	 */
	public function filter_event_statuses( $statuses, $event ) {
		$default_statuses = [
			[
				'text'     => $this->get_scheduled_label(),
				'id'       => 'scheduled',
				'value'    => 'scheduled',
				'selected' => 'scheduled' === $event->event_status ? true : false,
			],
			[
				'text'     => $this->get_canceled_label(),
				'id'       => 'canceled',
				'value'    => 'canceled',
				'selected' => 'canceled' === $event->event_status ? true : false,
			],
			[
				'text'     => $this->get_postponed_label(),
				'id'       => 'postponed',
				'value'    => 'postponed',
				'selected' => 'postponed' === $event->event_status ? true : false,
			]
		];

		$statuses = array_merge($statuses, $default_statuses );

		return $statuses;
	}

	/**
	 * Get the scheduled status label.
	 *
	 * @since TBD
	 *
	 * @return string The label for the scheduled status.
	 */
	public function get_scheduled_label() {

		/**
		 * Filter the scheduled label for event status.
		 *
		 * @since
		 *
		 * @param string The default label for the scheduled status.
		 */
		return apply_filters( 'tribe_events_status_scheduled_label', _x( 'Scheduled', 'Scheduled label.', 'the-events-calendar' ) );
	}

	/**
	 * Get the canceled status label.
	 *
	 * @since TBD
	 *
	 * @return string The label for the canceled status.
	 */
	public function get_canceled_label() {

		/**
		 * Filter the canceled label for event status.
		 *
		 * @since
		 *
		 * @param string The default label for the canceled status.
		 */
		return apply_filters( 'tribe_events_status_canceled_label', _x( 'Canceled', 'Canceled label.', 'the-events-calendar' ) );
	}

	/**
	 * Get the postponed status label.
	 *
	 * @since TBD
	 *
	 * @return string The label for the postponed status.
	 */
	public function get_postponed_label() {

		/**
		 * Filter the postponed label for event status.
		 *
		 * @since
		 *
		 * @param string The default label for the postponed status.
		 */
		return apply_filters( 'tribe_events_status_postponed_label', _x( 'Postponed', 'Postponed label', 'the-events-calendar' ) );
	}
}
