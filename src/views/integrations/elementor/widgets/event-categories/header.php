<?php
/**
 * View: Elementor Event Categories widget header.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe/events/integrations/elementor/widgets/event-categories/header.php
 *
 * @since TBD
 *
 * @var bool             $show_header Whether to show the header.
 * @var string           $header_tag  The HTML tag to use for the header.
 * @var string           $header_text The header text.
 * @var Event_Categories $widget      The widget instance.
 */

use TEC\Events\Integrations\Plugins\Elementor\Widgets\Event_Categories;

if ( ! $show_header ) {
	return;
}
?>

<<?php echo tag_escape( $header_tag ); ?> <?php tribe_classes( $widget->get_header_class() ); ?>>
	<?php echo esc_html( $header_text ); ?>
</<?php echo tag_escape( $header_tag ); ?>>
