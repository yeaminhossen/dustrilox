<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Brand extends Widget_Base {

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
		return 'brand';
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
		return __( 'Brand', 'tpcore' );
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
                    'tp_design_style' => 'layout-1'
                ],
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
                'default' => esc_html__('TP section description here', 'tpcore'),
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
            'tp_brand_section',
            [
                'label' => __( 'Brand Item', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'tp_brand_image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image 2', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'tp_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Type url here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tp_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
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

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>
          <section class="brand__area-2">
             <div class="container">
                <div class="row g-0">
                    <?php foreach ($settings['tp_brand_slides'] as $key => $item) : 
                        if ( !empty($item['tp_brand_image']['url']) ) {
                            $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                            $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        if ( !empty($item['tp_brand_image_2']['url']) ) {
                            $tp_brand_image_2_url = !empty($item['tp_brand_image_2']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image_2']['id'], $settings['thumbnail_size']) : $item['tp_brand_image_2']['url'];
                            $tp_brand_image_2_alt = get_post_meta($item["tp_brand_image_2"]["id"], "_wp_attachment_image_alt", true);
                        }

                        $border_bb = ($key < 4) ? 'brand__image-item-bb' : '';
                        $border_br = ($key == 3 || $key == 7 ) ? '' : 'brand__image-item-br';
                    ?>
                   <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                      <div class="brand__image-item <?php echo esc_attr($border_br); ?> <?php echo esc_attr($border_bb); ?>">
                        <?php if (!empty($item['tp_brand_url'])) : ?>
                        <a href="<?php echo esc_url($item['tp_brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>"></a>
                        <?php else : ?>
                        <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                        <?php endif; ?> 

                        <?php if (!empty($tp_brand_image_2_url)) : ?>
                         <div class="brand__image-item-ab">
                            <?php if (!empty($item['tp_brand_url'])) : ?>
                            <a href="<?php echo esc_url($item['tp_brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_2_url); ?>" alt="<?php echo esc_url($tp_brand_image_2_alt); ?>"></a>
                            <?php else : ?>
                            <img src="<?php echo esc_url($tp_brand_image_2_url); ?>" alt="<?php echo esc_url($tp_brand_image_2_alt); ?>">
                            <?php endif; ?> 
                         </div>
                         <?php endif; ?> 
                      </div>
                   </div>
                   <?php endforeach; ?>
                </div>
             </div>
          </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>

        <section class="brand__area-3 brand-border m-0">
             <div class="container">  
                <div class="brand__wrapper">
                   <div class="row g-0">
                    <?php foreach ($settings['tp_brand_slides'] as $key => $item) : 
                        if ( !empty($item['tp_brand_image']['url']) ) {
                            $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                            $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        if ( !empty($item['tp_brand_image_2']['url']) ) {
                            $tp_brand_image_2_url = !empty($item['tp_brand_image_2']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image_2']['id'], $settings['thumbnail_size']) : $item['tp_brand_image_2']['url'];
                            $tp_brand_image_2_alt = get_post_meta($item["tp_brand_image_2"]["id"], "_wp_attachment_image_alt", true);
                        }

                        $border_bb = ($key < 4) ? 'brand__image-item-bb' : '';
                        $border_br = ($key == 3 || $key == 7 ) ? '' : 'brand__image-item-br';
                    ?>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                          <div class="brand__image-item brand__image-item-3 <?php echo esc_attr($border_br); ?> <?php echo esc_attr($border_bb); ?>">
                            <?php if (!empty($item['tp_brand_url'])) : ?>
                            <a href="<?php echo esc_url($item['tp_brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>"></a>
                            <?php else : ?>
                            <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
                            <?php endif; ?> 
                          </div>
                       </div>
                    <?php endforeach; ?>   
                   </div>
                </div>
             </div>
          </section>


        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>        
          <section class="brand__area pb-120">
             <div class="container">
             	<?php if ( !empty($settings['tp_title']) ) : ?> 
                <div class="row">
                   <div class="col-xl-12">
                      <div class="brand__title text-center">
                         <span><?php echo tp_kses( $settings['tp_title' ]); ?></span>
                      </div>
                   </div>
                </div>
                <?php endif; ?>
                <div class="row">
                   <div class="col-xl-12">
                      <div class="brand__slider swiper-container">
                         <div class="swiper-wrapper">
    		                <?php foreach ($settings['tp_brand_slides'] as $item) : 
    		                    if ( !empty($item['tp_brand_image']['url']) ) {
    		                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
    		                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
    		                    }
    		                ?>
                            <div class="brand__slider-item swiper-slide">
    							<?php if (!empty($item['tp_brand_url'])) : ?>
    			                <a href="<?php echo esc_url($item['tp_brand_url']); ?>"><img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>"></a>
    			                <?php else : ?>
    			                <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_url($tp_brand_image_alt); ?>">
    			                <?php endif; ?>	
                            </div>
                            <?php endforeach; ?>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </section>
        <?php endif; ?>  

		<?php
	}


}

$widgets_manager->register( new TP_Brand() );