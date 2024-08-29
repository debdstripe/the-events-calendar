<?php

namespace Tribe\Events\Views\V2\Partials\Components\Events_Bar\Search;

use Tribe\Test\Products\WPBrowser\Views\V2\HtmlPartialTestCase;

class SubmitTest extends HtmlPartialTestCase
{

	protected $partial_path = 'components/events-bar/search/submit';

	/**
	 * Test render
	 */
	public function test_render() {
		$this->assertMatchesSnapshot( $this->get_partial_html() );
	}
}
