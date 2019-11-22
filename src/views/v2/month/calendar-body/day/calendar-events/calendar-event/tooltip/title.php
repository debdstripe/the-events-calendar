<?php
/**
 * View: Month View - Single Event Tooltip Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/views/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip/title.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTICLE_LINK_HERE}
 *
 * @version TBD
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

?>
<h3 class="tribe-events-calendar-month__calendar-event-tooltip-title tribe-common-h7">
	<a
		href="<?php echo esc_url( $event->permalink ) ?>"
		title="<?php echo esc_attr( get_the_title( $event->ID ) ); ?>"
		rel="bookmark"
		class="tribe-events-calendar-month__calendar-event-tooltip-title-link tribe-common-anchor-thin"
	>
		<?php echo wp_kses_post( get_the_title( $event->ID ) ); ?>
	</a>
</h3>
