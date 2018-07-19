/**
 * Created by mathias on 29/06/18.
 */

// Initialize Isotope
// =============================================
var filtr = "";

function startCode() {
    var $container = $('#container').isotope({
        itemSelector: '.element-item',
        layoutMode: 'fitRows',
        getSortData: {
            name: '[data-isotope-sort-name]'
        }
    });

    filterItemHandler();
    sortItemHandler();
    searchItemHandler();
};

// FILTER HANDLER
// =============================================
function filterItemHandler(){
    var $container = $('#container').isotope();

    $('#filters').on( 'click', 'button', function() {
        filtr = $( this ).attr('data-filter');

        $container.isotope({ filter: filtr });
        console.info( 'FILTER: ', filtr );
    });
}


// SEARCH HANDLER
// =============================================
function searchItemHandler(){
    var $container = $('#container').isotope();
    var qsRegex;

    var $quicksearch = $('#quicksearch').keyup( debounce( function() {
        qsRegex = new RegExp( $quicksearch.val(), 'gi' );
        $container.isotope({
            filter: function() {
                var $this = $(this);
                var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
                var buttonResult = filtr ? $this.is( filtr ) : true;
                return searchResult && buttonResult;
            }
        });
        // console.info( 'SEARCH: ', $grid.isotope() );
    }, 200 ) );
}

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
    var timeout;
    return function debounced() {
        if ( timeout ) {
            clearTimeout( timeout );
        }
        function delayed() {
            fn();
            timeout = null;
        }
        timeout = setTimeout( delayed, threshold || 100 );
    }
}


// SORT HANDLER
// =============================================
function sortItemHandler(){
    var $container = $('#container').isotope();

    $('#quicksort').on( 'click', function() {
        var sortValue = $(this).attr('data-sort-value');

        $container.isotope({ sortBy: 'name' });

        console.info( 'SORT: ', sortValue );
    });
}


// =============================================
// =============================================
$(document).ready(function(){
    var $color = ['orange', 'green', 'red', 'blue'];
    var $tier = ['dog', 'cat', 'mice', 'elefant'];
    var $elem = 200;

    // Append Items
    // ----------------------------
    for(var $i = 0; $i < $elem; $i++){
        var $random_color = Math.floor(Math.random() * 4);
        var $random_tier = Math.floor(Math.random() * 4);
        $('#container').append('<div class="element-item ' + $color[$random_color] + ' ' + $tier[$random_tier] + '" data-isotope-sort-name="' + $tier[$random_tier] + '"><span>' + $i + '</span>' + $tier[$random_tier] + '</div>');
    }
    // Append Buttons
    // ----------------------------
    for(var $i = 0; $i < $color.length; $i++){
        $('#filters').append('<button class="button" data-filter=".' +$color[$i]+ '">' +$color[$i]+ '</button>');
    }

    startCode();
});


// Set Hidden Classes for Isotope Items
// =============================================
var itemReveal = Isotope.Item.prototype.reveal;
Isotope.Item.prototype.reveal = function() {
    itemReveal.apply( this, arguments );
    $( this.element ).removeClass('isotope-hidden');
};

var itemHide = Isotope.Item.prototype.hide;
Isotope.Item.prototype.hide = function() {
    itemHide.apply( this, arguments );
    $( this.element ).addClass('isotope-hidden');
};

// Button Handler
// =============================================
$('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
        $('#quicksearch').val('');
    });
});