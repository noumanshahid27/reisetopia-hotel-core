jQuery(document).ready(function ($) {
    // api url
    const allhotel_apiurl = wpApiSettings.root + "reisetopia-hotels/v1/hotels";
    // default rest api callback
    reisetopia_restapi_callback(allhotel_apiurl, '', '','','','','');
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
                reisetopia_ajax_callback(hotel_name, hotel_location,'',max_price,order_by,order);
            } else {
                reisetopia_restapi_callback(allhotel_apiurl,hotel_name,hotel_location,'',max_price,order_by,order);
            }
    });
    
/*** price rang slider***/
const sliderRange = jQuery("#slider-range");

  sliderRange.slider({
    step: 500,
    range: true, 
    min: 0, 
    max: 1000000, 
    values: [0, 1000000], 
    change: function(event, ui) {
       var min_price = jQuery("#min_price_input").val(ui.values[0]);
      var max_price = jQuery("#max_price_input").val(ui.values[1]);
      //
    },
    create: function() {
      let values = jQuery(this).slider("option", "values");
      jQuery("#min_price_input").val(values[0]);
      jQuery("#max_price_input").val(values[1]);
    },
    slide: function(event, ui){
         jQuery("#min_price_input").val(ui.values[0]);
      jQuery("#max_price_input").val(ui.values[1]);
    reisetopia_restapi_callback(allhotel_apiurl,'', '',ui.values[0],ui.values[1],'','');
    }
  });
 jQuery("#priceRange").val(jQuery("#price-range").slider("values", 0) + " - " + jQuery("#price-range").slider("values", 1));
  // Input value to Integer.
  const toInt = input => {
    let val = Number(input);

    if (Number.isInteger(val)) {
      return Number(val);
    } else {
      return 0;
    }
  };

  // Bind onchange event to inputs.
  jQuery("#min_price_input").change(function() {
    let min_price_input = toInt(jQuery(this).val());
    let max_price_input = toInt(jQuery("#max_price_input").val());

    if (min_price_input >= max_price_input) {
      min_price_input = max_price_input;
    }
    reisetopia_restapi_callback(allhotel_apiurl,'', '',min_price_input,max_price_input,'','');
    sliderRange.slider("values", 0, min_price_input);
  });

  jQuery("#max_price_input").change(function() {
    let max_price_input = toInt(jQuery(this).val());
    let min_price_input = toInt(jQuery("#min_price_input").val());

    if (max_price_input <= min_price_input) {
      max_price_input = min_price_input;
    }
reisetopia_restapi_callback(allhotel_apiurl,'', '',min_price_input,max_price_input,'','');
    sliderRange.slider("values", 1, max_price_input);
  });
});
function reisetopia_ajax_callback(hotel_name, location,min_price,max_price,order_by,order) {
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
            min_price:min_price,
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
function reisetopia_restapi_callback(allhotel_apiurl, hotel_name = null, hotel_location = null,min_price=null,max_price= null,order_by,order) {

    finalapiurl = allhotel_apiurl + "/?name=" + hotel_name + "&location=" + hotel_location + "&min_price="+min_price+"&max_price="+max_price+ "&orderby="+order_by+"&order="+order;
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
