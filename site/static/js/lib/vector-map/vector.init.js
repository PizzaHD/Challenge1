( function ( $ ) {
    "use strict";





    jQuery( '#vmap' ).vectorMap( {
        map: 'world_en',
        backgroundColor: null,
        color: '#ffffff',
        hoverOpacity: 0.7,
        selectedColor: '#1de9b6',
        enableZoom: true,
        showTooltip: true,
        values: sample_data,
        scaleColors: [ '#1de9b6', '#03a9f5' ],
        normalizeFunction: 'polynomial'
    } );

    jQuery( '#vmap2' ).vectorMap( {
        map: 'world_en', //dz_fr
        color: '#007BFF',
        borderColor: '#fff',
        backgroundColor: '#fff',
        borderOpacity: 1,
        enableZoom: true,
        showTooltip: true
    } );

    jQuery( '#vmap3' ).vectorMap( {
        map: 'world_en', //argentina_en
        color: '#09F726',
        borderColor: '#fff',
        backgroundColor: '#fff',
        onRegionClick: function ( element, code, region ) {
            var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();

            alert( message );
        }
    } );

    jQuery( '#vmap4' ).vectorMap( {
        map: 'world_en', //brazil_br
        color: '#ECF709',
        borderColor: '#fff',
        backgroundColor: '#fff',
        onRegionClick: function ( element, code, region ) {
            var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();

            alert( message );
        }
    } );

   
} )( jQuery );



var map;

jQuery( document ).ready( function () {

    // Store currentRegion
    var currentRegion = 'fl';

    // List of Regions we'll let clicks through for
    var enabledRegions = [ 'mo', 'fl', 'or' ];

    map = jQuery( '#vmap15' ).vectorMap( {
        map: 'usa_en',
        color: '#007BFF',
        borderColor: '#fff',
        backgroundColor: '#fff',
        enableZoom: true,
        showTooltip: true,
        selectedColor: '#001BFF',
        selectedRegions: [ 'fl' ],
        hoverColor: null,
        colors: {
            mo: '#001BFF',
            fl: '#001BFF',
            or: '#001BFF'
        },
        onRegionClick: function ( event, code, region ) {
            // Check if this is an Enabled Region, and not the current selected on
            if ( enabledRegions.indexOf( code ) === -1 || currentRegion === code ) {
                // Not an Enabled Region
                event.preventDefault();
            } else {
                // Enabled Region. Update Newly Selected Region.
                currentRegion = code;
            }
        },
        onRegionSelect: function ( event, code, region ) {
            console.log( map.selectedRegions );
        },
        onLabelShow: function ( event, label, code ) {
            if ( enabledRegions.indexOf( code ) === -1 ) {
                event.preventDefault();
            }
        }
    } );
} );
