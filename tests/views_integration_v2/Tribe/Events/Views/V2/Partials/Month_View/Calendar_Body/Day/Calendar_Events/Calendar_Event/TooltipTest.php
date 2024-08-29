<?php

namespace Tribe\Events\Views\V2\Partials\Month_View\Calendar_Body\Day\Calendar_Events\Calendar_Event;

use Tribe\Test\PHPUnit\Traits\With_Post_Remapping;
use Tribe\Test\Products\WPBrowser\Views\V2\HtmlPartialTestCase;
use Tribe\Utils\Lazy_String;

class TooltipTest extends HtmlPartialTestCase
{
	use With_Post_Remapping;

	protected $partial_path = 'month/calendar-body/day/calendar-events/calendar-event/tooltip';

	/**
	 * Test render with event without featured image without description without cost
	 */
	public function test_render_with_event_without_featured_image_without_description_without_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->get_mock_event( 'events/single/1.json' );
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event with featured image without description without cost
	 */
	public function test_render_with_event_with_featured_image_without_description_without_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->mock_event( 'events/single/1.json' )->with_thumbnail()->get();
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event without featured image with description without cost
	 */
	public function test_render_with_event_without_featured_image_with_description_without_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->get_mock_event( 'events/single/1.json' );
		$event->excerpt = new Lazy_String(
			static function () {
				return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			}
		);
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event without featured image without description with cost
	 */
	public function test_render_with_event_without_featured_image_without_description_with_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->get_mock_event( 'events/single/1.json' );
		$event->cost = '$10';
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event with featured image with description without cost
	 */
	public function test_render_with_event_with_featured_image_with_description_without_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->mock_event( 'events/single/1.json' )->with_thumbnail()->get();
		$event->excerpt = new Lazy_String(
			static function () {
				return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			}
		);
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event with featured image without description with cost
	 */
	public function test_render_with_event_with_featured_image_without_description_with_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->mock_event( 'events/single/1.json' )->with_thumbnail()->get();
		$event->cost = '$10';
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event without featured image with description with cost
	 */
	public function test_render_with_event_without_featured_image_with_description_with_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->get_mock_event(  'events/single/1.json'  );
		$event->excerpt = new Lazy_String(
			static function () {
				return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			}
		);
		$event->cost = '$10';
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}

	/**
	 * Test render with event with featured image with description with cost
	 */
	public function test_render_with_event_with_featured_image_with_description_with_cost() {
		$date_formats = (object) [
			'month_and_year'       => 'F Y',
			'time_range_separator' => ' - ',
			'date_time_separator'  => ' @ ',
		];

		$event = $this->mock_event( 'events/single/1.json' )->with_thumbnail()->get();
		$event->excerpt = new Lazy_String(
			static function () {
				return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			}
		);
		$event->cost = '$10';
		$this->assertMatchesSnapshot( $this->get_partial_html( [ 'event' => $event, 'date_formats' => $date_formats ] ) );
	}
}
