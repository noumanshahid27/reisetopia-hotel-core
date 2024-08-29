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
         <div class="filter-row">
             <form name="post" class="hotels-filters" method="POST">
                 <div class="field-box">
                     <label for="hotel_name">Name</label>
                     <input type="text" class="field name-field" id="hotel_name"/>
                 </div>
                 <div class="field-box">
                      <label for="hotel_location">Location</label>
                     <input type="text" class="field location-field" id="hotel_location"/>
                 </div>
                 <div class="field-box source-row">
                     <label for="source">Data Source</label>
                     <select name="source" id="source" class="source-box field">
                         <option value="rest">REST</option>
                         <option value="ajax">AJAX</option>
    	            	
                     </select>
                 </div>
             </form>
         </div>
         <div id="result-output">
             <h3 class="result-title">Results</h3>
             <div class="hotels-list"></div>
         </div>
     </div>
 </div