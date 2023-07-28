/**
 * Internal dependencies
 */
import { actions } from '@moderntribe/events/data/blocks/venue';
import reducer, {
	defaultStateToMetaMap,
} from '@moderntribe/events/data/blocks/venue/reducer';

const data = {
	meta: {
		_EventVenueID: 42,
		_EventShowMap: false,
		_EventShowMapLink: true,
	},
};

jest.mock( '@moderntribe/common/utils/globals', () => ( {
	dateSettings: () => ( {} ),
	editorDefaults: () => ( {
		venue: 0,
		venueCountry: '',
		venueState: '',
		venueProvince: '',
	} ),
	list: () => ( {
		countries: {},
		us_states: {},
	} ),
	mapsAPI: () => ( {
		embed: true,
	} ),
} ) );

describe( '[STORE] - Venue reducer', () => {
	it( 'Should return the default state', () => {
		expect( reducer( undefined, {} ) ).toMatchSnapshot();
	} );

	it( 'Should set the venue', () => {
		expect( reducer( {}, actions.setVenue( 99 ) ) ).toMatchSnapshot();
	} );

	it( 'Should remove the venue', () => {
		expect( reducer( {}, actions.removeVenue() ) ).toMatchSnapshot();
	} );
} );
