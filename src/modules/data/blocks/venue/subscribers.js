/**
 * External dependencies
 */
import { differenceBy } from 'lodash';

/**
 * Internal dependencies
 */
import { globals } from '@moderntribe/common/utils';
import { editor } from '@moderntribe/common/data';
import { store } from '@moderntribe/common/store';
import { actions as formActions } from '@moderntribe/common/data/forms';
import {
	actions as venueActions,
	selectors as venueSelectors,
} from '@moderntribe/events/data/blocks/venue';
import { selectors as detailSelectors } from '@moderntribe/events/data/details';
import {getVenuesInBlock} from "./selectors";
const { getState, dispatch } = store;

/**
 * Returns criteria for comparing blocks.
 *
 * @exports
 * @param {Object} block Object with block attributes and data.
 * @returns {string} Client ID of the block.
 */
export const compareBlocks = block => block.clientId;

/**
 * Checks whether the block is the organizer block.
 *
 * @exports
 * @param {Object} block Object with block attributes and data.
 * @returns {boolean} Whether the block is the organizer block or not.
 */
export const isVenueBlock = ( block ) => block.name === 'tribe/event-venue';

/**
 * Handles the block that was added.
 *
 * @exports
 * @param {Object} block Object with block attributes and data.
 */
export const handleBlockAdded = ( block ) => {
	// only handle event venue block addition
	if ( ! isVenueBlock( block ) ) {
		return;
	}

	// return early if venue attribute is empty
	if ( ! block.attributes.venue ) {
		return;
	}

	dispatch( venueActions.addVenueInBlock( block.clientId, block.attributes.venue ) );
};

/**
 * Handles the block that was removed.
 *
 * @exports
 * @param {Array} currBlocks Array of current blocks in the editor.
 * @returns {Function} Function that handles the block that was removed.
 */
export const handleBlockRemoved = ( currBlocks ) => ( block ) => {
	// only handle event organizer block removal
	if ( ! isVenueBlock( block ) ) {
		return;
	}

	const classicBlock = currBlocks.filter( currBlock => (
		currBlock.name === 'tribe/classic-event-details'
	) );
	const venue = venueSelectors.getVenueByClientId( getState(), block );

	// remove venue from block state
	if ( venue ) {
		dispatch( venueActions.removeVenueInBlock( block.clientId, venue ) );
	}

	const volatile = detailSelectors.getVolatile( getState(), { name: venue } );

	if ( ! classicBlock.length || volatile ) {
		// remove organizer from classic state
		dispatch( venueActions.removeVenueInClassic( block.attributes.venue || 0 ) );
		dispatch( formActions.removeVolatile( venue ) );

		// set event organizer meta
		const blockVenues = venueSelectors.getVenuesInBlock( getState() );
		const postId = globals.wpData.select( 'core/editor' ).getCurrentPostId();
		const record = {
			meta: {
				_EventVenueID: blockVenues,
			},
		};

		globals.wpData.dispatch( 'core' ).editEntityRecord( 'postType', editor.EVENT, postId, record );
	}
};

/**
 * Handles changes in the blocks in the editor.
 *
 * @exports
 * @param {Array} currBlocks Array of current blocks in the editor.
 * @param {Array} prevBlocks Array of previous blocks in the editor.
 */
export const onBlocksChangeHandler = ( currBlocks, prevBlocks ) => {
	const blocksAdded = differenceBy( currBlocks, prevBlocks, compareBlocks );
	const blocksRemoved = differenceBy( prevBlocks, currBlocks, compareBlocks );

	if ( blocksAdded.length ) {
		blocksAdded.forEach( handleBlockAdded );
	}

	if ( blocksRemoved.length ) {
		blocksRemoved.forEach( handleBlockRemoved( currBlocks ) );
	}
};

/**
 * Listener for blocks change in the editor.
 *
 * @exports
 * @param {Function} selector Selector function to get current blocks.
 * @returns {Function} Listener that subscribes to WP store.
 */
export const onBlocksChangeListener = ( selector ) => {
	let holdBlocks = selector();
	return () => {
		const prevBlocks = holdBlocks;
		const currBlocks = selector();
		holdBlocks = currBlocks;

		if (
			prevBlocks.length !== currBlocks.length ||
			differenceBy( currBlocks, prevBlocks, compareBlocks ).length
		) {
			onBlocksChangeHandler( currBlocks, prevBlocks );
		}
	};
};

/**
 * @function subscribe
 * @description This subscribes to any changes in the wp data store.
 *              Since state and attribute changes should not be called
 *              in `componentDidMount()` and `componentWillUnmount()`,
 *              global state changes (tribe common store) and meta changes
 *              are handled in a global subscriber.
 */
const subscribe = () => {
	globals.wpData.subscribe(
		onBlocksChangeListener(
			globals.wpDataSelectCoreEditor().getBlocks,
		),
	);
};

export default subscribe;
