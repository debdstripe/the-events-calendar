<?php

namespace Tribe\Events\Views\V2\Partials\Month_View\Mobile_Events\Nav;

use Tribe\Test\Products\WPBrowser\Views\V2\HtmlPartialTestCase;

class Prev_DisabledTest extends HtmlPartialTestCase
{

	protected $partial_path = 'month/mobile-events/nav/prev-disabled';

	/**
	 * Test render with label
	 */
	public function test_render_with_label() {
		$this->assertMatchesSnapshot( $this->get_partial_html( [
			'label' => 'May',
		] ) );
	}
}
