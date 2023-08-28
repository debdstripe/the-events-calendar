<?php

namespace Tribe\Events\Editor\Blocks;

use Spatie\Snapshots\MatchesSnapshots;
use Tribe\Test\Products\WPBrowser\Views\V2\HtmlTestCase;

class Archive_EventsTest extends HtmlTestCase {
	use MatchesSnapshots;

	public function setUp(): void {
		parent::setUp();
		add_filter( 'tribe_editor_should_load_blocks', '__return_true', PHP_INT_MAX );
		tribe( \Tribe__Events__Editor__Provider::class )->register();
	}

	/**
	 * Test that the block is rendered.
	 */
	public function test_block_is_rendered() {
		ob_start();
		echo ( new Archive_Events() )->render();
		$block_content = ob_get_clean();

		$this->assertStringContainsString( 'tribe-block', $block_content );
		$this->assertStringContainsString( 'tribe-block__archive-events', $block_content );
		$this->assertMatchesSnapshot( $block_content );
	}
}
