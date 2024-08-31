<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * 
 *
 * @package		REISETOPIA
 * @subpackage	Classes/Reisetopia_Hotel_Core_Helpers
 * @author		Nouman shahid
 * @since		1.0.0
 */
 ?>
 <div class="reisetopia-hotels-wrapper">
     <div class="inner-wrapper">
         <h3 class="filter-title">Filters</h3>
         <div class="filters-section">
         <div class="filter-row">
             <form name="post" class="hotels-filters" method="POST">
                 <div class="filter-row">
                 <div class="field-box">
                     <label for="hotel_name">Name</label>
                     <input type="text" name="name" class="field name-field" id="hotel_name"/>
                 </div>
                 <div class="field-box">
                      <label for="hotel_location">Location</label>
                     <input type="text" name="location" class="field location-field" id="hotel_location"/>
                 </div>
                 <div class="field-box">
                      <label for="max_price">Price</label>
                     <input type="number" name="max_price" class="field price-field" id="max_price"/>
                 </div>
                 <div class="field-box source-row">
                     <label for="source">Data Source</label>
                     <select name="source" id="source" class="source-box field">
                         <option value="rest">REST</option>
                         <option value="ajax">AJAX</option>
    	            	
                     </select>
                 </div>
                </div>
            <div class="sorting-row filter-row">
              <div class="field-box sorting-row">
                     <label for="sorting_type">Sorting Type</label>
                     <select name="sorting_type" id="sorting_type" class="sorting-type field">
                         <option value="title">Name</option>
                         <option value="price_range_min">Minimum Price</option>
                         <option value="price_range_max">Maximum Price</option>
    	            	
                     </select>
                 </div>
            <div class="field-box sorting-row">
                     <label for="sorting_order">Sorting Order</label>
                     <select name="sorting_order" id="sorting_order" class="sorting-order field">
                         <option value="asc">Ascending</option>
                         <option value="desc">Descending</option>
    	            	
                     </select>
                 </div>
         </div>
         <div class="filter-row price-range-filter">
             <label for="slider-range">Price Range</label>
            <input type="number" name="min_price" id="min_price_input" class="price-field">
            <input type="number" name="max_price" id="max_price_input" class="price-field">
            <div id="slider-range"></div>
         </div>
             </form>
         </div>
         </div>
         </div>
         <div id="result-output">
             <h3 class="result-title">Results</h3>
             <div class="hotels-list"></div>
         </div>
     </div>
 </div>