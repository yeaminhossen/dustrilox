<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'advanced-tab';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Advanced Tab', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_desctiption',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();


		$this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'tpcore'),
                'default' => __('Tab Title', 'tpcore'),
                'placeholder' => __('Type Tab Title', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => __('Is Active Tab?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'tpcore'),
                'placeholder' => __('Select a section template for as tab content', 'tpcore'),
  
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'tpcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'tpcore' ),
					'uppercase' => __( 'UPPERCASE', 'tpcore' ),
					'lowercase' => __( 'lowercase', 'tpcore' ),
					'capitalize' => __( 'Capitalize', 'tpcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>


		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title', 'class', 'section__title');
        ?>
          <section class="pricing__area">
             <div class="container">
                <div class="row align-items-center">
                    <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                   <div class="col-xl-6 col-lg-6">
                      <div class="section__wrapper mb-55">
                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>
                         <?php if ( !empty($settings['tp_sub_title']) ) : ?> 
                         <div class="r-text">   
                            <span class="st-1"><?php echo tp_kses( $settings['tp_sub_title'] ); ?> </span>
                         </div>
                         <?php endif; ?>
                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>
                      </div>
                   </div>
                   <?php endif; ?>
                   <div class="col-xl-6 col-lg-6">
                      <div class="pricing__tabs-2">
                         <ul class="nav nav-tabs" id="priceTab" role="tablist">
                            <?php foreach ($settings['tabs'] as $key => $tab):
                                $active = ($key == 0) ? 'active' : '';
                            ?>
                            <li class="nav-item" role="presentation">
                               <button class="nav-link nav-button-one <?php echo esc_attr($active); ?>" id="monthly-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#monthly-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="monthly-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
                            </li>
                            <?php endforeach; ?>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="tab-content" id="priceTabContent">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 0) ? 'show active' : '';
                    ?>
                   <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="monthly-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="monthly-tab-<?php echo esc_attr($key); ?>">
                       <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?> 
                   </div>
                   <?php endforeach; ?>
                </div>
             </div>
          </section>


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title', 'class', 'section__title');
        ?>

      <section class="company__about">
         <div class="row g-0">
            <div class="col-xl-12">
               <div class="company__about-tab">
                  <ul class="nav nav-tabs about-tabs" id="myTab" role="tablist">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 1) ? 'active' : '';
                    ?>
                     <li class="nav-item abst-item" role="presentation">
                        <button class="nav-link <?php echo esc_attr($active); ?> abst-item-link" id="profile-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#profile-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="profile-<?php echo esc_attr($key); ?>" aria-selected="false"><?php echo tp_kses($tab['title']); ?>  <i class="fa-light fa-arrow-down-long"></i></button>
                     </li>
                    <?php endforeach; ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="tab-content company__about-tabs-content" id="myTabContent">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        $active = ($key == 1) ? 'show active' : '';
                    ?>
                  <div class="tab-pane fade show <?php echo esc_attr($active); ?> pt-90 pb-40" id="profile-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="profile-tab-<?php echo esc_attr($key); ?>">
                     <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?> 
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </section>



		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
			$this->add_render_attribute('title', 'class', 'section__title-sd');
		?>

      <section class="pricing__area-2">
         <div class="container">
            <div class="row align-items-center">
            	<?php if ( !empty($settings['tp_section_title_show']) ) : ?>
               <div class="col-xl-6 col-lg-6 col-md-7">
                  <div class="section-2__wrapper mb-55">
                  	 <?php if ( !empty($settings['tp_sub_title']) ) : ?> 
                     <span class="st-1"><?php echo tp_kses( $settings['tp_sub_title'] ); ?> </span>
                     <?php endif; ?>

					<?php
		                if ( !empty($settings['tp_title' ]) ) :
		                    printf( '<%1$s %2$s>%3$s</%1$s>',
		                        tag_escape( $settings['tp_title_tag'] ),
		                        $this->get_render_attribute_string( 'title' ),
		                        tp_kses( $settings['tp_title' ] )
		                        );
		                endif;
		            ?>

					<?php if ( !empty($settings['tp_desctiption']) ) : ?>
		                <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
		            <?php endif; ?>
                  </div>
               </div>
               <?php endif; ?>
               
               <div class="col-xl-6 col-lg-6 col-md-5">
                  <div class="pricing__tabs">
                     <ul class="nav nav-tabs" id="priceTab" role="tablist">
                     	<?php foreach ($settings['tabs'] as $key => $tab):
                        	$active = ($key == 0) ? 'active' : '';
                        ?>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link <?php echo esc_attr($active); ?>" id="monthly-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#monthly-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="monthly-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
                        </li>
                        <?php endforeach; ?>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="tab-content" id="priceTabContent">
            	<?php foreach ($settings['tabs'] as $key => $tab):
                    $active = ($key == 0) ? 'show active' : '';
                ?>
               <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="monthly-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="monthly-tab-<?php echo esc_attr($key); ?>">
                  <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>	
               </div>
               <?php endforeach; ?>
            </div>
         </div>
      </section>

	    <?php endif; ?>

		<?php
	}

}
$widgets_manager->register( new TP_Advanced_Tab() );