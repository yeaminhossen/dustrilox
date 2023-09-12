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
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tpcore' );
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
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
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
            'tp_meta_desctiption',
            [
                'label' => esc_html__('Meta Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section meta description here', 'tpcore'),
                'placeholder' => esc_html__('Type section meta description here', 'tpcore'),
            ]
        );


        $this->add_control(
            'tp_meta_img',
            [
                'label' => esc_html__('Image Cntent', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section meta description here', 'tpcore'),
                'placeholder' => esc_html__('Type section meta description here', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-5'
                ]
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
                    'text-left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        // Features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-2','layout-4']
                ]
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
                    'style_4' => __( 'Style 4', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
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
                        'tp_features_icon_type' => 'icon'
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
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'tpcore'),
                'label_block' => true,
            ]
        );           

        $repeater->add_control(
            'tp_features_url', [
                'label' => esc_html__('URL', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_4'
                ]
            ]
        );        

        $repeater->add_control(
            'tp_features_sub_title', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );        
     
        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );
        $this->end_controls_section();


		$this->start_controls_section(
            '_tp_icon',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-10'
                ],
            ]
        );
        $this->add_control(
            'tp_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $this->add_control(
            'tp_icon_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_icon_type' => 'image'
                ]

            ]
        );
        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_selected_icon',
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
                        'tp_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $this->end_controls_section();

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );        

        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2','layout-3','layout-4','layout-5']
                ],
            ]
        );        

        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-3','layout-5']
                ],
            ]
        );        

        $this->add_control(
            'tp_image_4',
            [
                'label' => esc_html__( 'Choose Image 4', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-5']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2_url = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'section__title-sd');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-d');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-d');
                }
            }

        ?>

      <section class="about__area">
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-6">
                  <div class="about__right">
                     <div class="about__info pb-20">
                        <div class="section-2__wrapper mb-30">
                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                               <span class="st-1"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                            ?>
                        </div>

                         <?php if ( !empty($settings['tp_meta_desctiption']) ) : ?> 
                         <p class="about__info-quote"><?php echo tp_kses( $settings['tp_meta_desctiption'] ); ?></p>
                         <?php endif; ?>

                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="about__list mt-40">
                        <div class="row">
                            <?php foreach ($settings['tp_features_list'] as $key => $item) : 
                                $item_class = $key == 1 ? 'absp-text-1' : 'absp-text-2';
                            ?>
                           <div class="col-xl-6">
                              <div class="about__list-item mb-30">
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

                                 <h5 class="about__list-item-title"> <?php echo tp_kses($item['tp_features_title' ]); ?></h5>
                              </div>
                           </div>
                           <?php endforeach; ?> 
                        </div>
                     </div>
                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                     <div class="about__button mt-20">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                     </div>
                    <?php endif; ?> 
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="about__image">
                     <?php if ( !empty($tp_image) ) : ?>
                     <div class="about__image-big">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </div>
                     <?php endif; ?>
                     <?php if ( !empty($tp_image_2_url) ) : ?>
                     <div class="about__image-small">
                        <img src="<?php echo esc_url($tp_image_2_url); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                     </div>
                     <?php endif; ?>
                     <div class="about__image-shape">
                        <span></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2_url = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3_url = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'section__title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-3');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-3');
                }
            }

        ?>

      <section class="about__area">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6">
                  <div class="abs__info mb-30">
                     <?php if ( !empty($tp_image) ) : ?>
                     <div class="abs__image-1 w-img">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </div>
                     <?php endif; ?>
                     <?php if ( !empty($tp_image_2_url) ) : ?>
                     <div class="abs__image-2 w-img">
                        <img src="<?php echo esc_url($tp_image_2_url); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                     </div>
                     <?php endif; ?>
                     <?php if ( !empty($tp_image_3_url) ) : ?>
                     <div class="abs__image-3 w-img">
                        <img src="<?php echo esc_url($tp_image_3_url); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="ab-left-content">
                     <div class="section__wrapper section__wrapper-2 mb-30">  
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>      
                        <span class="st-meta"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>
                     </div>
                     <?php if ( !empty($settings['tp_meta_desctiption']) ) : ?> 
                     <div class="st-right-border">
                         <?php echo tp_kses( $settings['tp_meta_desctiption'] ); ?>
                     </div>
                     <?php endif; ?>

                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="sm-text mb-45"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                     <div class="ab-button">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                     </div>
                    <?php endif; ?> 
                  </div>
               </div>
            </div>
         </div>
      </section>


        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2_url = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }            

            $this->add_render_attribute('title_args', 'class', 'section__title-sm');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-touch-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-touch-btn');
                }
            }

        ?>

      <section class="about__area pt-120 pb-155">
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-6">
                  <div class="about__image about__image-2">
                     <?php if ( !empty($tp_image_url) ) : ?>
                     <div class="about__image-big">
                        <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                     </div>
                     <?php endif; ?>
                     <?php if ( !empty($tp_image_2_url) ) : ?>
                     <div class="about__image-small about__image-small-2">
                        <img src="<?php echo esc_url($tp_image_2_url); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="about__right-2">
                     <div class="about__info pb-20">
   
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                        <span><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        <?php endif; ?>


                        <div class="section-2__wrapper mb-30">
                            <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                            ?>
                        </div>
                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="proceess__list pt-30">
                        <?php foreach ($settings['tp_features_list'] as $key => $item) : 
                            $item_class = $key == 1 ? 'absp-text-1' : 'absp-text-2';
                        ?>
                        <div class="process__list-item mb-30">
                           <div class="process__list-info">
                              <div class="process__list-icon">
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
                              <div class="process__list-content">
                                 <h5 class="process__list-item-title"><?php echo tp_kses($item['tp_features_title' ]); ?></h5>
                              </div>
                           </div>
                           <?php if (!empty($item['tp_features_url'])): ?>
                           <div class="process__list-sp-icon">
                              <a href="<?php echo tp_kses($item['tp_features_url' ]); ?>"><i class="fa-light fa-arrow-right-long"></i></a>
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php endforeach; ?> 
                     </div>

                        <?php if ( !empty($settings['tp_meta_desctiption']) ) : ?> 
                         <p class="process__text"><?php echo tp_kses( $settings['tp_meta_desctiption'] ); ?></p>
                        <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                     <div class="about__button mt-35">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                     </div>
                    <?php endif; ?>  
                  </div>
               </div>
            </div>
         </div>
      </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2_url = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 

            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3_url = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }               

            if ( !empty($settings['tp_image_4']['url']) ) {
                $tp_image_4_url = !empty($settings['tp_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_image_4']['id'], $settings['tp_image_size_size']) : $settings['tp_image_4']['url'];
                $tp_image_4_alt = get_post_meta($settings["tp_image_4"]["id"], "_wp_attachment_image_alt", true);
            }           

            $this->add_render_attribute('title_args', 'class', 'section__title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-d');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-d');
                }
            }

        ?>

      <section class="about__area-2">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="about__sm-image about__sm-image-df">
                           <?php if ( !empty($tp_image_url) ) : ?>  
                           <div class="sm-image__item w-img mb-30">
                              <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                           </div>
                           <?php endif; ?>
                           <?php if ( !empty($tp_image_2_url) ) : ?>  
                           <div class="sm-image__item w-img mb-30">
                              <img src="<?php echo esc_url($tp_image_2_url); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                              <?php if ( !empty($settings['tp_meta_img']) ) : ?>  
                              <div class="sm-image__content">
                                 <div class="sm-number">
                                    <?php echo tp_kses( $settings['tp_meta_img'] ); ?>
                                 </div>
                              </div>
                              <?php endif; ?>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="about__sm-image">
                            <?php if ( !empty($tp_image_3_url) ) : ?>  
                           <div class="sm-image__item w-img mb-30">
                              <img src="<?php echo esc_url($tp_image_3_url); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                           </div>
                           <?php endif; ?>
                           <?php if ( !empty($tp_image_4_url) ) : ?>  
                           <div class="sm-image__item w-img mb-30">
                              <img src="<?php echo esc_url($tp_image_4_url); ?>" alt="<?php echo esc_attr($tp_image_4_alt); ?>">
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="ab-left-content">
                     <div class="section__wrapper mb-30">
                        <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                        <div class="r-text">
                           <span><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                        </div>
                        <?php endif; ?>

                     </div>

                     <?php if ( !empty($settings['tp_meta_desctiption']) ) : ?> 
                     <?php echo tp_kses( $settings['tp_meta_desctiption'] ); ?>
                     <?php endif; ?>


                    <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                    <p class="sm-text mb-45"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_text'])) : ?>
                     <div class="ab-button mb-30">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                     </div>
                    <?php endif; ?> 
                  </div>
               </div>
            </div>
         </div>
      </section>

		<?php else: 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image_url = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

			$this->add_render_attribute('title_args', 'class', 'section__title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }
		?>	


          <section class="about__area">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-6 col-lg-6">
                      <div class="ab-tab-info mb-30">
                        <?php if ( !empty($tp_image_url) ) : ?>  
                         <div class="ab-image w-img">
                            <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                         </div>
                         <?php endif; ?>

                        <?php foreach ($settings['tp_features_list'] as $key => $item) : 
                            $item_class = $key == 1 ? 'absp-text-1' : 'absp-text-2';
                        ?>
                         <div class="absp-text <?php echo esc_attr($item_class); ?>">
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

                            <div class="absp-info">
                               <h5><span class="counter"><?php echo tp_kses($item['tp_features_title' ]); ?></span>+</h5>
                               <span class="absm-title"><?php echo tp_kses($item['tp_features_sub_title' ]); ?></span>
                            </div>
                         </div>
                         <?php endforeach; ?> 
                      </div>
                   </div>

                   <div class="col-xl-6 col-lg-6">
                      <div class="ab-left-content">
                         <div class="section__wrapper mb-30">
                            <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                            ?>
                            
                             <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                            <div class="r-text">
                               <span><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
                            </div>
                            <?php endif; ?>
                         </div>

                         <?php if ( !empty($settings['tp_meta_desctiption']) ) : ?> 
                         <?php echo tp_kses( $settings['tp_meta_desctiption'] ); ?>
                         <?php endif; ?>


                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p class="sm-text mb-45"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_btn_text'])) : ?>
                         <div class="ab-button mb-30">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?> 
                      </div>
                   </div>
                </div>
             </div>
          </section>


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About() );