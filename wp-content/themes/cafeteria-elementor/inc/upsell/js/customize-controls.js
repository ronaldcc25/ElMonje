( function( api ) {

	// Extends our custom "cafeteria-elementor" section.
	api.sectionConstructor['cafeteria-elementor'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );