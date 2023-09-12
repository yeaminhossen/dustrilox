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
class TP_Portfolio extends Widget_Base {

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
		return 'portfolio-list';
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
		return __( 'Portfolio', 'tpcore' );
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
                    'tp_design_style' => 'layout-3'
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

        // Service group
        $this->start_controls_section(
            'tp_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'tpcore'),
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
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_cat', [
                'label' => esc_html__('Category', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category', 'tpcore'),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'tp_portfolio_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
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
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Mobile Development', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ],
                    [
                        'tp_portfolio_title' => esc_html__('Mobile Development', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_portfolio_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_portfolio_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );

        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();

        // tp_portfolio_columns_section
        $this->start_controls_section(
            'tp_portfolio_columns_section',
            [
                'label' => esc_html__('Portfolio - Columns', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_portfolio__for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_portfolio__for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_portfolio__for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 576px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            '
            ',
            [
                'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 576px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // TAB_STYLE
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
        <div class="project__area fix">
            <div class="project__inner">
                <?php foreach ($settings['tp_portfolio_list'] as $item) : 
                    if ( !empty($item['tp_portfolio_image']['url']) ) {
                        $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                        $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // Link
                    if ('2' == $item['tp_portfolio_link_type']) {
                        $link = get_permalink($item['tp_portfolio_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                        $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
               <div class="project__info">
                  <div class="project__info-image">
                     <img src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="project-bg">
                  </div>
                  <div class="project__content">
                    <?php if (!empty($item['tp_portfolio_cat' ])) : ?>
                      <span><?php echo tp_kses($item['tp_portfolio_cat' ]); ?></span>
                    <?php endif; ?>
                     <h5 class="p-title">
                        <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                        <?php else : ?>
                            <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                        <?php endif; ?>
                     </h5>

                    <?php if (!empty($link)) : ?>
                    <div class="project__button mt-40">
                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-d"><?php echo tp_kses($item['tp_portfolio_btn_text']); ?></a>
                    </div>
                    <?php endif; ?>
                  </div>
               </div>
               <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'section__title');
        ?>
          <section class="project__area fix">
             <div class="container">
                <div class="row align-items-center">
                    <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                   <div class="col-xl-6 col-lg-6 col-md-6">
                      <div class="section__wrapper section__wrapper-2 mb-50">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?> 
                            <span class="st-meta"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
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
                      <?php endif; ?>
                   </div>
                   <div class="col-xl-6 col-lg-6 col-md-6">
                      <!-- If we need navigation buttons -->
                      <div class="project__slider-arrow-wrapper mb-50 text-sm-end">
                         <div class="project__slider-arrow">
                            <div class="project-button-prev ms-button-3 ms-button-3-border"><i class="far fa-long-arrow-left"></i> Prev</div>
                            <div class="project-button-next ms-button-3">Next <i class="far fa-long-arrow-right"></i></div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-xl-12">
                      <div class="project__slider project__slider-active swiper-container">
                         <div class="project___slider-wrapper swiper-wrapper">
                            <?php foreach ($settings['tp_portfolio_list'] as $item) : 
                                if ( !empty($item['tp_portfolio_image']['url']) ) {
                                    $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                    $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                // Link
                                if ('2' == $item['tp_portfolio_link_type']) {
                                    $link = get_permalink($item['tp_portfolio_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                                    $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                }
                            ?>
                            <div class="project__slider-item swiper-slide">
                               <div class="project__slider-item-image mb-30" style="background-image: url(<?php echo esc_url($tp_portfolio_image_url); ?>);">
                                  <div class="project__slider-item-overlay">
                                     <a class="popup-image" href="<?php echo esc_url($tp_portfolio_image_url); ?>"><i class="fa-solid fa-plus"></i></a>
                                  </div>
                               </div>
                                  <?php if (!empty($item['tp_portfolio_cat' ])) : ?>
                                  <span><?php echo tp_kses($item['tp_portfolio_cat' ]); ?></span>
                                  <?php endif; ?>
                                  <h5 class="project__slider-item-title">
                                    <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                    <?php endif; ?>
                                  </h5>

                            </div>
                            <?php endforeach; ?>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </section>


		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'title');
		?>	

      <section class="sd-banner-area">
         <div class="banner__slider swiper-container">
            <div class="banner__wrapper swiper-wrapper">
                <?php foreach ($settings['tp_portfolio_list'] as $item) : 
                    if ( !empty($item['tp_portfolio_image']['url']) ) {
                        $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                        $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // Link
                    if ('2' == $item['tp_portfolio_link_type']) {
                        $link = get_permalink($item['tp_portfolio_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                        $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
               <div class="sd-banner__item swiper-slide" style="background-image: url(<?php echo esc_url($tp_portfolio_image_url); ?>);">
                  <div class="container-0">
                     <div class="row g-0">
                        <div class="col-xl-3 banner-slide-height d-none d-xl-block">
                           <div class="slide-border"></div>
                        </div>
                        <div class="col-xl-3 banner-slide-height">
                           <div class="slide-border"></div>
                           <div class="sd-content">
                              <?php if (!empty($item['tp_portfolio_cat' ])) : ?>
                              <span class="sd-meta"><?php echo tp_kses($item['tp_portfolio_cat' ]); ?></span>
                              <?php endif; ?>
                              <h5>
                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_portfolio_title' ]); ?>
                                <?php endif; ?>
                              </h5>

                            <?php if (!empty($link)) : ?>
                            <div class="project-info">
                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><i class="fal fa-plus"></i></a>
                                <span><a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_btn_text']); ?></a></span>
                            </div>
                            <?php endif; ?>
                              <div class="sd-bg-icon">
                                 <i class="flaticon-industrial"></i>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-3 banner-slide-height d-none d-xl-block">
                           <div class="slide-border"></div>
                        </div>
                        <div class="col-xl-3 banner-slide-height d-none d-xl-block">
                           <div class="slide-border"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endforeach; ?>
            </div>
         </div>
      </section> 

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Portfolio() );