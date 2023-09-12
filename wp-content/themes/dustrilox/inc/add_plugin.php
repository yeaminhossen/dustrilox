<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme madison for publication on ThemeForest
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action( 'tgmpa_register', 'dustrilox_register_required_plugins' );

function dustrilox_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */

    $url = 'https://weblearnbd.net/wp/dustrilox/source/';
    $acf_url = 'https://weblearnbd.net/plugin/';

    $plugins = [
        [
            'name'     => esc_html__( 'Elementor Page Builder', 'dustrilox' ),
            'slug'     => 'elementor',
            'required' => true,
        ],
        [
            'name'         => esc_html__( 'TP Core ', 'dustrilox' ),
            'slug'         => 'tp-core',
            'source'       => $url . 'tp-core.zip',
            'required'     => true,
        ],
        [
            'name'         => esc_html__( 'Advanced Custom Fields Pro', 'dustrilox' ),
            'slug'         => 'advanced-custom-fields-pro',
            'source'       => $acf_url . 'advanced-custom-fields-pro.zip',
            'required'     => true,
        ],
        [
            'name'     => esc_html__( 'WP Classic Editor', 'dustrilox' ),
            'slug'     => 'classic-editor',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'dustrilox' ),
            'slug'     => 'contact-form-7',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'dustrilox' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Mailchimp For WP', 'dustrilox' ),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ],
        array(
            'name'     =>  esc_html__('Kirki Customizer Framework','dustrilox'),
            'slug'     => 'kirki',
            'required' => false,
        ), 
        array(
            'name'     =>  esc_html__('Breadcrumb NavXT','dustrilox'),
            'slug'     => 'breadcrumb-navxt',
            'required' => false,
        )     

    ];
    $config = [
        'id'           => 'dustrilox', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true, // Show admin notices or not.
        'dismissable'  => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message'      => '', // Message to output right before the plugins table.

        'strings'      => [
            'page_title'                      => esc_html__( 'Install Required Plugins', 'dustrilox' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'dustrilox' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'dustrilox' ),
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'dustrilox' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'dustrilox' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'dustrilox'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'dustrilox'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'dustrilox'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'dustrilox'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'dustrilox'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'dustrilox'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'dustrilox'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'dustrilox'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'dustrilox'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'dustrilox' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'dustrilox' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'dustrilox' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'dustrilox' ),
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'dustrilox' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'dustrilox' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'dustrilox' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'dustrilox' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'dustrilox' ),
            'nag_type'                        => '',
        ],
    ];
    tgmpa( $plugins, $config );
}
