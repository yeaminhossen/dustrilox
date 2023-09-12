<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Main_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'Main Slider', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'hero_search_switch',
            [
                'label' => __('Hero Search Show/Hide', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tp_design_style' => 'layout-2',
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

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
	            'tp_slider_image',
	            [
	                'label' => esc_html__('Upload Image', 'tpcore'),
	                'type' => Controls_Manager::MEDIA,
	                'default' => [
	                    'url' => Utils::get_placeholder_image_src(),
	                ]
	            ]
	        );

			$repeater->add_control(
	            'tp_features_icon_type',
	            [
	                'label' => esc_html__('Select Icon Type', 'tpcore'),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'default' => 'icon',
	                'options' => [
	                    'image' => esc_html__('Image', 'tpcore'),
	                    'icon' => esc_html__('Icon', 'tpcore'),
	                ],
	                'condition' => [
	                    'repeater_condition' => 'style_1'
	                ]
	            ]
	        );

	        $repeater->add_control(
	            'tp_features_image',
	            [
	                'label' => esc_html__('Upload Icon Image', 'tpcore'),
	                'type' => Controls_Manager::MEDIA,
	                'default' => [
	                    'url' => Utils::get_placeholder_image_src(),
	                ],
	                'condition' => [
	                    'tp_features_icon_type' => 'image'
	                ]
	            ]
	        );

	        if (tp_is_elementor_version('<', '2.6.0')) {
	            $repeater->add_control(
	                'tp_features_icon',
	                [
	                    'show_label' => false,
	                    'type' => Controls_Manager::ICON,
	                    'label_block' => true,
	                    'default' => 'fa-solid fa-check',
	                    'condition' => [
	                        'tp_features_icon_type' => 'icon',
	                        'repeater_condition' => 'style_1'
	                    ]
	                ]
	            );
	        } else {
	            $repeater->add_control(
	                'tp_features_selected_icon',
	                [
	                    'show_label' => false,
	                    'type' => Controls_Manager::ICONS,
	                    'fa4compatibility' => 'icon',
	                    'label_block' => true,
	                    'default' => [
	                        'value' => 'fas fa-star',
	                        'library' => 'solid',
	                    ],
	                    'condition' => [
	                        'tp_features_icon_type' => 'icon',
	                        'repeater_condition' => 'style_1'
	                    ]
	                ]
	            );
	        }

            $repeater->add_control(
                'tp_slider_sub_title',
                [
                    'label' => esc_html__('Sub Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'basic' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                    'label_block' => true,
                ]
            );            

            $repeater->add_control(
                'tp_slider_thumb_sub_title',
                [
                    'label' => esc_html__('Bottom Sub Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'basic' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__('Type Bottom Sub title Text', 'tpcore'),
                    'label_block' => true,
                    'condition' => [
	                    'repeater_condition' => 'style_1'
	                ]
                ]
            );
            $repeater->add_control(
                'tp_slider_title',
                [
                    'label' => esc_html__('Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Grow business.', 'tpcore'),
                    'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'tp_slider_title_tag',
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

            $repeater->add_control(
                'tp_slider_description',
                [
                    'label' => esc_html__('Description', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                    'placeholder' => esc_html__('Type section description here', 'tpcore'),
                ]
            ); 

            $repeater->add_control(
                'tp_slider_mailchimp',
                [
                    'label' => esc_html__('Form Shortcode', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'basic' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__('Shortcode here', 'tpcore'),
                    'label_block' => true,
                    'condition' => [
	                    'repeater_condition' => 'style_2'
	                ]
                ]
            );               

            // button 01 
			$repeater->add_control(
	            'tp_btn_link_switcher',
	            [
	                'label' => esc_html__( 'Add Button link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SWITCHER,
	                'label_on' => esc_html__( 'Yes', 'tpcore' ),
	                'label_off' => esc_html__( 'No', 'tpcore' ),
	                'return_value' => 'yes',
	                'default' => 'yes',
	                'separator' => 'before',
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_btn_text',
	            [
	                'label' => esc_html__('Button Text', 'tpcore'),
	                'type' => Controls_Manager::TEXT,
	                'default' => esc_html__('Button Text', 'tpcore'),
	                'title' => esc_html__('Enter button text', 'tpcore'),
	                'label_block' => true,
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes'
	                ],
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link_type',
	            [
	                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
	                    '1' => 'Custom Link',
	                    '2' => 'Internal Page',
	                ],
	                'default' => '1',
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes'
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link',
	            [
	                'label' => esc_html__( 'Button Link link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::URL,
	                'dynamic' => [
	                    'active' => true,
	                ],
	                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
	                'show_external' => true,
	                'default' => [
	                    'url' => '#',
	                    'is_external' => false,
	                    'nofollow' => false,
	                ],
	                'condition' => [
	                    'tp_btn_link_type' => '1',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_page_link',
	            [
	                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT2,
	                'label_block' => true,
	                'options' => tp_get_all_pages(),
	                'condition' => [
	                    'tp_btn_link_type' => '2',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );

	        // button 02
			$repeater->add_control(
	            'tp_btn_2_link_switcher',
	            [
	                'label' => esc_html__( 'Add Button 2 link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SWITCHER,
	                'label_on' => esc_html__( 'Yes', 'tpcore' ),
	                'label_off' => esc_html__( 'No', 'tpcore' ),
	                'return_value' => 'yes',
	                'default' => 'yes',
	                'separator' => 'before',
	                'condition' => [
	                    'repeater_condition' => 'style_1'
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_2_btn_text',
	            [
	                'label' => esc_html__('Button 2 Text', 'tpcore'),
	                'type' => Controls_Manager::TEXT,
	                'default' => esc_html__('Button Text', 'tpcore'),
	                'title' => esc_html__('Enter button text', 'tpcore'),
	                'label_block' => true,
	                'condition' => [
	                    'tp_btn_2_link_switcher' => 'yes',
	                    'repeater_condition' => 'style_1'
	                ],
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_2_link_type',
	            [
	                'label' => esc_html__( 'Button 2 Link Type', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
	                    '1' => 'Custom Link',
	                    '2' => 'Internal Page',
	                ],
	                'default' => '1',
	                'condition' => [
	                    'tp_btn_2_link_switcher' => 'yes',
	                    'repeater_condition' => 'style_1'
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_2_link',
	            [
	                'label' => esc_html__( 'Button 2 Link link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::URL,
	                'dynamic' => [
	                    'active' => true,
	                ],
	                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
	                'show_external' => true,
	                'default' => [
	                    'url' => '#',
	                    'is_external' => false,
	                    'nofollow' => false,
	                ],
	                'condition' => [
	                    'tp_btn_2_link_type' => '1',
	                    'tp_btn_2_link_switcher' => 'yes',
	                    'repeater_condition' => 'style_1'
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_2_page_link',
	            [
	                'label' => esc_html__( 'Select Button 2 Link Page', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT2,
	                'label_block' => true,
	                'options' => tp_get_all_pages(),
	                'condition' => [
	                    'tp_btn_2_link_type' => '2',
	                    'tp_btn_2_link_switcher' => 'yes',
	                    'repeater_condition' => 'style_1'
	                ]
	            ]
	        );


        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();


        // Style
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
      <section class="slider__area grey-bg-8 pt-120 pb-120">
         <div class="container">
            <div class="slider__active swiper-container">
               <div class="slider__wrapper swiper-wrapper">
           		<?php foreach ($settings['slider_list'] as $item) :
        			$this->add_render_attribute('title_args', 'class', 'slider__d-title');
					$this->add_render_attribute('title_args', 'data-animation', 'fadeInLeft');
					$this->add_render_attribute('title_args', 'data-delay', '.7s');

 					if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }

					// btn Link 01
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }

                ?>
                  <div class="slider__item swiper-slide">
                     <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6 col-md-7">
                           <div class="slider__d-info">
                           		<?php if (!empty($item['tp_slider_sub_title'])) : ?>
                               <span data-animation="fadeInUp" data-delay=".3s"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                               <?php endif; ?>

                               <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                ?>
								<?php if (!empty($item['tp_slider_description'])) : ?>
                                 <p class="slider__p-text mb-45" data-animation="fadeInLeft" data-delay=".7s"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                 <?php endif; ?>

                              <?php if (!empty($item['tp_slider_mailchimp'])) : ?>   
                              <div class="subscribe-form subscribe-form-2 p-relative mb-30">
                                 <?php echo do_shortcode($item['tp_slider_mailchimp']); ?>
                             </div>
                             <?php endif; ?>

                             <div class="slider-2-btn">
                             	<?php if (!empty($link)) : ?>
                               	   	<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn mr-30">
                                    	<?php echo tp_kses($item['tp_btn_btn_text']); ?> <i class="fal fa-angle-right"></i>
                                    </a>
                                 <?php endif; ?>
                             </div>

                           </div>
                        </div>

                        <?php if (!empty($tp_slider_image_url)) : ?>
                        <div class="col-xl-5 col-lg-6 col-md-5 d-none d-md-block">
                           <div class="slider__image text-center w-img">
                              <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="">
                           </div>
                        </div>
                        <?php endif; ?>

                     </div>
                     <div class="slider__circle-shape"></div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
         <!-- If we need navigation buttons -->
         <div class="swiper-button-prev ms-button-2"><i class="far fa-long-arrow-left"></i></div>
         <div class="swiper-button-next ms-button-2"><i class="far fa-long-arrow-right"></i></div>
      </section>


		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
		?>
      <section class="slider-area fix">
         <div class="swiper main-slider swiper-container swiper-container-fade">
            <div class="swiper-wrapper p-relative">
           		<?php foreach ($settings['slider_list'] as $item) :
        			$this->add_render_attribute('title_args', 'class', 'slider-title');
					$this->add_render_attribute('title_args', 'data-animation', 'fadeInUp');
					$this->add_render_attribute('title_args', 'data-delay', '.6s');

 					if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }

					// btn Link 01
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }

					// btn Link 02
                    if ('2' == $item['tp_btn_2_link_type']) {
                        $link2 = get_permalink($item['tp_btn_2_page_link']);
                        $target2 = '_self';
                        $rel2 = 'nofollow';
                    } else {
                        $link2 = !empty($item['tp_btn_2_link']['url']) ? $item['tp_btn_2_link']['url'] : '';
                        $target2 = !empty($item['tp_btn_2_link']['is_external']) ? '_blank' : '';
                        $rel2 = !empty($item['tp_btn_2_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?> 
               <div class="item-slider sliderm-height p-relative swiper-slide">
                  <div class="slide-bg" data-background="<?php echo esc_url($tp_slider_image_url); ?>"></div>
                  <div class="container">
                     <div class="row ">
                        <div class="col-lg-12">
                           <div class="slider-contant mt-25">

                           		<?php if (!empty($item['tp_slider_sub_title'])) : ?>
                               <span data-animation="fadeInUp" data-delay=".3s"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                               <?php endif; ?>

                               <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                ?>

                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                 <p data-animation="fadeInUp" data-delay=".7s"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                 <?php endif; ?>

                               <div class="slider-button" data-animation="fadeInUp" data-delay=".9s">
                               	   <?php if (!empty($link)) : ?>
                               	   	<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn mr-30">
                                    	<?php echo tp_kses($item['tp_btn_btn_text']); ?> <i class="fal fa-angle-right"></i>
                                    </a>
                                   <?php endif; ?>


                               	   <?php if (!empty($link2)) : ?>
                               	   	<a target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>" class="tp-btn-2">
                                    	<?php echo tp_kses($item['tp_btn_2_btn_text']); ?> <i class="fal fa-angle-right"></i>
                                    </a>
                                   <?php endif; ?>
                               </div>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               	<?php endforeach; ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev ms-button"><i class="far fa-long-arrow-left"></i></div>
            <div class="swiper-button-next ms-button"><i class="far fa-long-arrow-right"></i></div>
         </div>
      </section>


      <section class="main-slider-dot">
         <div class="container">
            <div class="swiper main-slider-nav">
               <div class="swiper-wrapper">
           		<?php foreach ($settings['slider_list'] as $item) :
        			$this->add_render_attribute('title_args', 'class', 'slider__title');
					$this->add_render_attribute('title_args', 'data-animation', 'fadeInUp');
					$this->add_render_attribute('title_args', 'data-delay', '.6s');

 					if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }

					// btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>                   
                 <div class="swiper-slide">
                     <div class="sm-button">
                        <div class="sm-services__icon">
                          <?php if($item['tp_features_icon_type'] !== 'image') : ?>
                                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                    <span><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                                <?php endif; ?>   
                            <?php else : ?>
                                <span class="keyFeatureBlock__icon">
                                    <?php if (!empty($item['tp_features_image']['url'])): ?>
                                    <img class="light" src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>  
                                </span>
                            <?php endif; ?> 
                        </div>
                        <div class="sm-services__text">
                           <span><?php echo tp_kses(tp_kses($item['tp_slider_thumb_sub_title'])); ?></span>
                           <h4><?php echo tp_kses(tp_kses($item['tp_slider_title'])); ?></h4>
                        </div>
                     </div>
                  </div>
                <?php endforeach; ?>  
               </div>
            </div>
         </div>
      </section>

         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Main_Slider() );