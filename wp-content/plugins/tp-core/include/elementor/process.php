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
class TP_Process extends Widget_Base {

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
		return 'process';
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
		return __( 'Process', 'tpcore' );
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

        $this->add_control(
            'tp_section_shape_show',
            [
                'label' => esc_html__( 'Shape ?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
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

        // Service group
        $this->start_controls_section(
            'tp_process',
            [
                'label' => esc_html__('Process List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_process_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_process_selected_icon',
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
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_process_step', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_process_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_process_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_process_url', [
                'label' => esc_html__('URL', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_process_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_process_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Develop', 'tpcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Deliver', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_process_align',
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
      <section class="process__area">
         <div class="container">
            <div class="row mt-30">
               <?php foreach ($settings['tp_process_list'] as $item) : ?> 
               <div class="col-xl-3 col-lg-3 col-md-6">
                  <div class="process__item text-center mb-40">
                     <div class="process__content">
                        <div class="process__list-icon2 mb-20">
                            <?php if($item['tp_process_icon_type'] !== 'image') : ?>
                                <?php if (!empty($item['tp_process_icon']) || !empty($item['tp_process_selected_icon']['value'])) : ?>
                                    <div class="pro-icon">
                                        <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                                    </div>
                                <?php endif; ?>   
                            <?php else : ?>
                                <div class="pro-icon">
                                    <?php if (!empty($item['tp_process_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>   
                                </div>
                            <?php endif; ?> 
                        </div>
                        <?php if (!empty($item['tp_process_title' ])): ?>
                            <span><?php echo tp_kses($item['tp_process_step' ]); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($item['tp_process_title' ])): ?>
                        <h5 class="p-name mt-20">
                            <?php if (!empty($item['tp_process_url' ])): ?>
                            <a href="<?php echo esc_url($item['tp_process_url' ]); ?>"><?php echo tp_kses($item['tp_process_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo tp_kses($item['tp_process_title' ]); ?>
                            <?php endif; ?>
                        </h5>
                        <?php endif; ?>
                        <?php if (!empty($item['tp_process_url' ])): ?>
                        <div class="process__more">
                           <a href="<?php echo esc_url($item['tp_process_url' ]); ?>"><i class="fa-light fa-arrow-right-long"></i></a>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endforeach; ?> 
            </div>
         </div>
      </section>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'title');
            $shape_swtich = ($settings['tp_section_shape_show'] == 'yes' ) ? '' : 'shape-off p-0';
		?>	

         <div class="proceess__list">
            <?php foreach ($settings['tp_process_list'] as $item) : ?>
            <div class="process__list-item mb-30">
               <div class="process__list-info">
                  <div class="process__list-icon">
                    <?php if($item['tp_process_icon_type'] !== 'image') : ?>
                        <?php if (!empty($item['tp_process_icon']) || !empty($item['tp_process_selected_icon']['value'])) : ?>
                            <div class="pro-icon">
                                <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                            </div>
                        <?php endif; ?>   
                    <?php else : ?>
                        <div class="pro-icon">
                            <?php if (!empty($item['tp_process_image']['url'])): ?>
                            <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>   
                        </div>
                    <?php endif; ?> 
                  </div>
                  <div class="process__list-content">
                    <?php if (!empty($item['tp_process_title' ])): ?>
                        <span><?php echo tp_kses($item['tp_process_step' ]); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_process_title' ])): ?>
                    <h5>
                        <?php if (!empty($item['tp_process_url' ])): ?>
                        <a href="<?php echo esc_url($item['tp_process_url' ]); ?>"><?php echo tp_kses($item['tp_process_title' ]); ?></a>
                        <?php else : ?>
                        <?php echo tp_kses($item['tp_process_title' ]); ?>
                        <?php endif; ?>
                    </h5>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_process_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_process_description']); ?></p>
                    <?php endif; ?>
                  </div>
               </div>
               <?php if (!empty($item['tp_process_url' ])): ?>
               <div class="process__list-sp-icon">
                  <a href="<?php echo esc_url($item['tp_process_url' ]); ?>"><i class="fa-light fa-arrow-right-long"></i></a>
               </div>
               <?php endif; ?>
            </div>
            <?php endforeach; ?> 
         </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Process() );