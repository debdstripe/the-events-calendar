<?php
/**
 * View: Elementor Event Organizer widget header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-organizer/details/email/content.php
 *
 * @since TBD
 *
 * @var string $organizer The organizer ID.
 * @var Tribe\Events\Integrations\Elementor\Widgets\Event_Organizer $widget The widget instance.
 */

?>
<p <?php tribe_classes( $widget->get_email_base_class() ); ?>>
	<?php if ( $link_organizer_email ) : ?>
		<?php // For a dial link we remove spaces, and replace 'ext' or 'x' with 'p' to pause before dialing the extension. ?>
		<a <?php tribe_classes( $widget->get_email_base_class() . '-link' ); ?> href="<?php echo esc_url( 'mailto:' . $organizer['email'] ); ?>">
	<?php endif; ?>
		<?php echo esc_html( $organizer['email'] ); ?>
	<?php if ( $link_organizer_email ) : ?>
		</a>
	<?php endif; ?>
</p>
