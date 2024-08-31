<?php
/**
 * Reisetopia Hotel Core
 *
 * @package       REISETOPIA
 * @author        Nouman shahid
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Reisetopia Hotel Core
 * Plugin URI:    https://reisetopia.de/
 * Description:   This is the core functionality of reisetopia
 * Version:       1.0.0
 * Author:        Nouman shahid
 * Author URI:    https://www.noumanshahid.com
 * Text Domain:   reisetopia-hotel-core
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Reisetopia Hotel Core. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'REISETOPIA_NAME',			'Reisetopia Hotel Core' );

// Plugin version
define( 'REISETOPIA_VERSION',		'1.0.0' );

// Plugin Root File
define( 'REISETOPIA_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'REISETOPIA_PLUGIN_BASE',	plugin_basename( REISETOPIA_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'REISETOPIA_PLUGIN_DIR',	plugin_dir_path( REISETOPIA_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'REISETOPIA_PLUGIN_URL',	plugin_dir_url( REISETOPIA_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once REISETOPIA_PLUGIN_DIR . 'core/class-reisetopia-hotel-core.php';
//acf integration
require_once REISETOPIA_PLUGIN_DIR . 'acf/acf.php';
/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Nouman shahid
 * @since   1.0.0
 * @return  object|Reisetopia_Hotel_Core
 */
function REISETOPIA() {
	return Reisetopia_Hotel_Core::instance();
}

REISETOPIA();
