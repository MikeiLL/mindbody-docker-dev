<?php
/**
 * PHPUnit bootstrap file.
 *
 * @package My_Plugin
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

# print_r("BEFORE \n");
# print_r(\PHPUnit\Framework\Error\Deprecated::$enabled);
# \PHPUnit\Framework\Error\Deprecated::$enabled = false;
# print_r("AFTER \n");
# print_r(\PHPUnit\Framework\Error\Deprecated::$enabled);
# print_r("\n");

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

// Forward custom PHPUnit Polyfills configuration to PHPUnit bootstrap file.
$_phpunit_polyfills_path = getenv( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH' );
if ( false !== $_phpunit_polyfills_path ) {
	define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', $_phpunit_polyfills_path );
}

if ( ! file_exists( "{$_tests_dir}/includes/functions.php" ) ) {
	echo "Could not find {$_tests_dir}/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once "{$_tests_dir}/includes/functions.php";

/**
 * Manually load the plugin being tested.
 */
if (!function_exists("_manually_load_plugins")) {
	function _manually_load_plugins() {
		require dirname( __FILE__ ) . '/wp-content/plugins/mz-mindbody-api/mz-mindbody.php';
		require dirname( __FILE__ ) . '/wp-content/plugins/mindbody-access-management/mz-mbo-access.php';
	}
}


tests_add_filter( 'muplugins_loaded', '_manually_load_plugins' );

// Start up the WP testing environment.
require_once "{$_tests_dir}/includes/bootstrap.php";
