jQuery(document).ready(function ($) {
    // api url
    const allhotel_apiurl = wpApiSettings.root + "reisetopia-hotels/v1/hotels";
    // default rest api callback
    reisetopia_restapi_callback(allhotel_apiurl, '', '');
    // ajax call method
    // on input change
    jQuery(".hotels-filters .field").keyup(function () {
        var length_check = jQuery(this).val();
        var hotel_name = jQuery("#hotel_name").val();
        var hotel_location = jQuery("#hotel_location").val();
        var source = jQuery("#source").val();
        console.log("check value in keyup", hotel_location);
        console.log("check length", jQuery(this).length);
            if (source == "ajax") {
                reisetopia_ajax_callback(hotel_name, hotel_location);
            } else {
                reisetopia_restapi_callback(
                    allhotel_apiurl,
                    hotel_name,
                    hotel_location
                );
            }
    });
});
function reisetopia_ajax_callback(hotel_name, location) {
    jQuery.ajax({
        url: reisetopia_ajax.ajaxurl,
        type: "post",
        dataType: "json",
        data: {
            action: "reisetopia_hotels_get_all",
            nonce: reisetopia_ajax.nonce, // pass the nonce here
            hotel_name: hotel_name,
            hotel_location: location,
        },
        error: function (response, error) {
            console.log("wrong");
        },

        success: function (response) {
                hotel_output_format(response);

        },
    });
}
function reisetopia_restapi_callback(allhotel_apiurl, hotel_name = null, hotel_location = null) {

    finalapiurl = allhotel_apiurl + "/?name=" + hotel_name + "&location=" + hotel_location;
    // Make a GET request to retrieve posts
    fetch(finalapiurl, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((hotellists) => {
            console.log(hotellists);
            console.log('hotel list length', Object.keys(hotellists).length);
            hotel_output_format(hotellists);
           
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
function hotel_output_format(hotellists){
    console.log(hotellists);
     var output = '';
    jQuery('#result-output .hotels-list').html();
            if(hotellists.code == 'no_hotel_found'){
                jQuery('#result-output .hotels-list').html(hotellists.message);
            }
            if(Object.keys(hotellists).length >= 1 && hotellists.code == undefined){
                for (var i = 0; i < Object.keys(hotellists).length; i++) {
                    console.log('rating',hotellists[i].rating);
                    output += '<div class="hotel-item"><h4 class="hotel-name">' + hotellists[i].name + 
                    '</h4><div class="hotel-info"><p class="location"><span>location:</span><span>' + hotellists[i].city + ',' + hotellists[i].country + '</span></p>'+
                    '<p class="price-range"><span>Price range:</span><span>' + hotellists[i].priceRange.min + ' - ' + hotellists[i].priceRange.max + '€</span></p>';
                    if (typeof hotellists[i].rating !== "undefined") {
                         output +='<p class="rating"><span>Rating: <span>(' + hotellists[i].rating + ')</span></span></p>';
                    };
                     output += '</div></div>';
    
                }
                 jQuery('#result-output .hotels-list').html(output);
            }
}
