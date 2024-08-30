jQuery(document).ready(function ($) {
    // api url
    const allhotel_apiurl = wpApiSettings.root + "reisetopia-hotels/v1/hotels";
    // default rest api callback
    reisetopia_restapi_callback(allhotel_apiurl, '', '','','','');
    // ajax call method
    // on input change
    jQuery(".hotels-filters .field").on("keyup change", function(e) {
        var hotel_name = jQuery("#hotel_name").val();
        var hotel_location = jQuery("#hotel_location").val();
        var max_price = jQuery("#max_price").val();
        var source = jQuery("#source").val();
        var order_by = jQuery("#sorting_type").val();
        var order = jQuery("#sorting_order").val();
            if (source == "ajax") {
                reisetopia_ajax_callback(hotel_name, hotel_location,max_price,order_by,order);
            } else {
                reisetopia_restapi_callback(
                    allhotel_apiurl,
                    hotel_name,
                    hotel_location,
                    max_price,
                    order_by,
                    order
                );
            }
    });
});
function reisetopia_ajax_callback(hotel_name, location,max_price,order_by,order) {
    jQuery.ajax({
        url: reisetopia_ajax.ajaxurl,
        type: "post",
        dataType: "json",
        data: {
            action: "reisetopia_hotels_get_all",
            security: reisetopia_ajax.nonce, // pass the nonce here
            hotel_name: hotel_name,
            hotel_location: location,
            max_price:max_price,
            order_by:order_by,
            order:order,
            
        },
        error: function (response, error) {
            console.log("wrong");
        },

        success: function (response) {
                hotel_output_format(response);

        },
    });
}
function reisetopia_restapi_callback(allhotel_apiurl, hotel_name = null, hotel_location = null,max_price= null,order_by,order) {

    finalapiurl = allhotel_apiurl + "/?name=" + hotel_name + "&location=" + hotel_location + "&max_price="+max_price+ "&orderby="+order_by+"&order="+order;
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
            hotel_output_format(hotellists);
           
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
function hotel_output_format(hotellists){
     var output = '';
    jQuery('#result-output .hotels-list').html();
            if(hotellists.code == 'no_hotel_found'){
                jQuery('#result-output .hotels-list').html(hotellists.message);
            }
            if(Object.keys(hotellists).length >= 1 && hotellists.code == undefined){
                for (var i = 0; i < Object.keys(hotellists).length; i++) {
                    output += '<div class="hotel-item"><h4 class="hotel-name">' + hotellists[i].name + 
                    '</h4><div class="hotel-info"><p class="location"><span>location:</span><span>' + hotellists[i].city + ',' + hotellists[i].country + '</span></p>'+
                    '<p class="price-range"><span>Price range:</span><span>' + hotellists[i].priceRange.min + ' - ' + hotellists[i].priceRange.max + '€</span></p>';
                    if (typeof hotellists[i].rating !== "undefined") {
                         output +='<p class="rating"><span>Rating: <span><img class="rating" src="'+reisetopia_ajax.plugin_dir+'core/includes/assets/img/star-ratings.png" alt="rating-icon"/>(' + hotellists[i].rating + ')</span></span></p>';
                    };
                     output += '</div></div>';
    
                }
                 jQuery('#result-output .hotels-list').html(output);
            }
}
/*** price rang slider***/
