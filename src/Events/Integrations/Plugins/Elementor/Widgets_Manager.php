<?php
/**
 * Handles Registering Elementor widgets.
 *
 * @since   TBD
 *
 * @package TEC\Events\Integrations\Plugins\Elementor
 */

namespace TEC\Events\Integrations\Plugins\Elementor;

use Elementor\Plugin as Elementor_Plugin;
use TEC\Common\Contracts\Provider\Controller;

/**
 * Class Widget_Manager
 *
 * @since   TBD
 *
 * @package TEC\Events\Integrations\Plugins\Elementor
 */
class Widgets_Manager extends Controller {
	/**
	 * A list of widget classes to register.
	 *
	 * @since TBD
	 *
	 * @var array
	 */
	protected array $widget_classes = [
		Widgets\Event_Categories::class,
		Widgets\Event_Cost::class,
		Widgets\Event_Datetime::class,
		Widgets\Event_Description::class,
		Widgets\Event_Export::class,
		Widgets\Event_Image::class,
		Widgets\Event_Navigation::class,
		Widgets\Event_Organizer::class,
		Widgets\Event_Tags::class,
		Widgets\Event_Title::class,
		Widgets\Event_Venue::class,
		Widgets\Event_Website::class,
	];

	/**
	 * Registers the filters and actions hooks added by the controller.
	 *
	 * @since TBD
	 */
	public function do_register(): void {
		if ( ! class_exists( 'Elementor\Widget_Base', false ) ) {
			return;
		}

		foreach ( $this->get_widgets() as $widget_class ) {
			$this->container->bind( $widget_class, $widget_class );
		}

		$this->container->bind( Widgets\Event_Container::class, Widgets\Event_Container::class );

		$this->register_with_elementor();
	}

	/**
	 * Removes the filters and actions hooks added by the controller.
	 *
	 * Bound implementations should not be removed in this method!
	 *
	 * @since TBD
	 *
	 * @return void Filters and actions hooks added by the controller are be removed.
	 */
	public function unregister(): void {}

	/**
	 * Gets a filtered list of the widgets to be registered with Elementor.
	 *
	 * @since TBD
	 *
	 * @return array
	 */
	public function get_widget_classes(): array {
		$classes = $this->widget_classes;

		/**
		 * Allows filtering the widget classes to be registered with Elementor.
		 *
		 * @since TBD
		 *
		 * @param array $classes The widget classes to be registered with Elementor.
		 *
		 * @return array
		 */
		return apply_filters( 'tec_events_elementor_widget_classes', $classes );
	}

	/**
	 * Returns the widgets to be registered with Elementor.
	 *
	 * @since TBD
	 *
	 * @return array
	 */
	public function get_widgets(): array {
		/**
		 * Allows filtering the widgets to be registered with Elementor.
		 *
		 * @since TBD
		 *
		 * @param array $widgets The widgets to be registered with Elementor.
		 */
		$widgets = $this->get_widget_classes();

		// Ensure that all filtered widgets are instances of Widget_Abstract.
		foreach ( $widgets as $widget ) {
			$widget_instance = new $widget();

			// Remove the widget if it is not an instance of Widget_Abstract.
			if ( ! $widget_instance instanceof Widgets\Contracts\Abstract_Widget ) {
				unset( $widgets[ get_class( $widget_instance ) ] );
			}

			unset( $widget_instance );
		}

		return $widgets;
	}

	/**
	 * Registers the widgets with Elementor.
	 *
	 * @since TBD
	 */
	public function register_with_elementor(): void {
		$widgets = $this->get_widgets();

		foreach ( $widgets as $widget ) {
			$widget_instance = new $widget();
			Elementor_Plugin::instance()->widgets_manager->register( tribe( get_class( $widget_instance ) ) );
		}
	}
}
