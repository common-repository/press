<?php
/**
 * @package Press
 * @version 1.0.1
 */

/*
Plugin Name:  Press
Plugin URI:   http://makedo.in/products/
Description:  Press releases for WordPress
Author:       Make Do
Version:      1.0.1
Author URI:   http://makedo.in
Licence:      GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0.html

*/

// 1  - Admin options screen
require_once 'admin-options.php';

// 2  - Enqueue scripts
require_once 'admin-scripts.php';

// 3  - Create custom post type
require_once 'admin-post-type-press-news.php';

// 4  - Create Press category custom taxonomy
require_once 'admin-taxonomy-press-category.php';

// 5 - Query arguments
require_once 'ui-query-arguments-press.php';

// 6 - Render upcoming newss list
require_once 'ui-render-news-list.php';

// 7 - Render news view
require_once 'ui-render-news.php';

// 8 - Shortcode to display news list
require_once 'ui-shortcode-render-news-list.php';

// 9 - Shortcode to display news list as bullets
require_once 'ui-shortcode-render-news-bullets.php';

// 10 - Featured press meta box
require_once 'admin-meta-box-press-featured.php';

// 11 - News information meta box
require_once 'admin-meta-box-press-information.php';

// 12 - Added archived post status
require_once 'admin-post-status-press-archived.php';

?>