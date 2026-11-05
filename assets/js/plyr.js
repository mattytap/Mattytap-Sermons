if ( typeof sm_data === 'undefined' ) {
	sm_data = {
		debug: false,
		use_native_player_safari: false,
	};
} else {
	sm_data.debug = sm_data.debug === '1';
	sm_data.use_native_player_safari = sm_data.use_native_player_safari === '1';
}

window.addEventListener( 'DOMContentLoaded', function () {
	const options = {
		debug: sm_data.debug,
		enabled: sm_data.use_native_player_safari ? ( !/Safari/.test( navigator.userAgent ) || ( /Safari/.test( navigator.userAgent ) && /Chrome|OPR/.test( navigator.userAgent ) ) ) : true,
		// Ask YouTube and Vimeo to track visitors less: YouTube plays from youtube-nocookie.com.
		youtube: { noCookie: true },
		vimeo: { dnt: true },
	};

	// Load Plyr's icons from this site, when the plugin says where they are.
	if ( sm_data.icon_url ) {
		options.iconUrl = sm_data.icon_url;
	}

	const players = Plyr.setup( document.querySelectorAll( '.wpfc-sermon-player,.wpfc-sermon-video-player' ), options );

	for ( let p in players ) {
		if ( players.hasOwnProperty( p ) ) {
			players[ p ].on( 'loadedmetadata ready', function ( event ) {
				let instance = event.detail.plyr;

				if ( instance.elements.original.dataset.plyr_seek !== undefined ) {
					instance.currentTime = parseInt( instance.elements.original.dataset.plyr_seek );
				}
			} );
		}
	}
} );
