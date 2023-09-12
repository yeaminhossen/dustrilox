<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'tpcore' );
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
                    '{{WRAPPER}} .tp-sec-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );
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

        // Blog Query
		$this->start_controls_section(
            'tp_post_query',
            [
                'label' => esc_html__('Blog Query', 'tpcore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'tpcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'tpcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'tpcore'),
                'description' => esc_html__('Select a category to exclude', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => tp_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'tpcore' ),
                    'desc' 	=> esc_html__( 'Descending', 'tpcore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'tpcore'),
                'description' => esc_html__('Set how many word you want to displa!', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'tp_post_content',
            [
                'label' => __('Content', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'tp_post_content_limit',
            [
                'label' => __('Content Limit', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_post_content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_post_btn',
            [
                'label' => __('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Button', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();


        // layout Panel
        $this->start_controls_section(
            'tp_post_',
            [
                'label' => esc_html__('Blog - Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Blog Overlay', 'tpcore'),
                    'layout-2' => esc_html__('Blog List', 'tpcore')
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_control(
            'tp_post__height',
            [
                'label' => esc_html__( 'Height', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );

        $this->add_control(
            'tp_post_border',
            [
                'label' => esc_html__('Border?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );

        $this->add_control(
            'tp_post__dots',
            [
                'label' => esc_html__('Dots?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-1',
                ),
            ]
        );        

        $this->add_control(
            'tp_post__arrow',
            [
                'label' => esc_html__('Arrow Icons?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_control(
            'tp_post__infinite',
            [
                'label' => esc_html__('Infinite?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-1',
                ),
            ]
        );
        $this->add_control(
            'tp_post__autoplay',
            [
                'label' => esc_html__('Autoplay?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-1',
                ),
            ]
        );        
        $this->add_control(
            'tp_post__autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => '2500',
                'title' => esc_html__('Enter autoplay speed', 'tpcore'),
                'label_block' => true,
                'condition' => array(
                    'tp_post__autoplay' => 'yes',
                    'tp_design_style' => 'layout-1',
                ),
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
        $this->add_control(
            'tp_post__pagination',
            [
                'label' => esc_html__( 'Pagination', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'tp_design_style' => 'layout-1!',
                ),
            ]
        );
        $this->end_controls_section();

        // tp_post__columns_section
        $this->start_controls_section(
            'tp_post__columns_section',
            [
                'label' => esc_html__('Blog - Columns', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_post___for_desktop',
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
            'tp_post___for_laptop',
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
            'tp_post___for_tablet',
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

        // tp_post__slider_columns_section
		$this->start_controls_section(
            'tp_post__slider_columns_section',
            [
                'label' => esc_html__('Blog - Columns for Carousel', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_post__slider_for_xl_desktop',
            [
                'label' => esc_html__( 'Columns for Extra Large Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1920px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_post__slider_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_post__slider_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_post__slider_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '2',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_post__slider_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 767', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_post__slider_for_xs_mobile',
            [
                'label' => esc_html__( 'Columns for Extra Small Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 575px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        // style control


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

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);

        // var_dump($query);

        $carousel_args = [
            'arrows' => ('yes' === $settings['tp_post__arrow']),
            'dots' => ('yes' === $settings['tp_post__dots']),
            'autoplay' => ('yes' === $settings['tp_post__autoplay']),
            'autoplay_speed' => absint($settings['tp_post__autoplay_speed']),
            'infinite' => ('yes' === $settings['tp_post__infinite']),
            'for_xl_desktop' => absint($settings['tp_post__slider_for_xl_desktop']),
            'slidesToShow' => absint($settings['tp_post__slider_for_desktop']),
            'for_laptop' => absint($settings['tp_post__slider_for_laptop']),
            'for_tablet' => absint($settings['tp_post__slider_for_tablet']),
            'for_mobile' => absint($settings['tp_post__slider_for_mobile']),
            'for_xs_mobile' => absint($settings['tp_post__slider_for_xs_mobile']),
        ];
        $this->add_render_attribute('tp-carousel-post-data', 'data-settings', wp_json_encode($carousel_args));

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tp-el-title');
        ?>

            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $categories = get_the_category($post->ID);
                $border_class = $settings['tp_post_border'] ? 'blog__item-2-df' : '';
            ?>
          <div class="blog__item-2 <?php echo esc_attr($border_class); ?> mb-40">
             <div class="blog__item-2-image">
                 <div class="blog__item-2-image-inner w-img">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                    </a>
                 </div>
                 <div class="blog__item-2-date">
                   <a href="<?php the_permalink(); ?>" class="month">
                      <?php the_time( 'j' ); ?>
                   <span><?php the_time( 'F' ); ?></span>
                   </a>
                 </div>
             </div>
             <div class="blog__item-2-content">
                <div class="blog__meta">
                   <div class="blog__author">
                      <i class="fal fa-user"></i>
                      <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php print get_the_author();?></a></span>
                   </div>
                   <div class="blog__catagory">
                      <span><?php echo esc_html($categories[0]->name); ?></span>
                   </div>
                </div>
                <h5 class="blog__sm-title">
                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                </h5>
                
                <?php if (!empty($settings['tp_post_content'])):
                    $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                    ?>
                    <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                <?php endif; ?>

             </div>
             <div class="blog__btn-2">
                <a href="<?php the_permalink(); ?>" class="link-btn"> <?php echo esc_html($settings['tp_post_btn']); ?> <i class="fal fa-long-arrow-right"></i></a>
             </div>
          </div>
            <?php endwhile; wp_reset_query(); ?>
            <?php endif; ?>

        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tp-el-title');
        ?>

       <?php if ($query->have_posts()) : ?> 
      <section class="blog__area">
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                  <div class="blog-slider__active swiper-container">
                     <div class="blog-slider__wrapper swiper-wrapper">
                        <?php while ($query->have_posts()) : 
                        $query->the_post();
                        global $post;


                        $categories = get_the_category($post->ID);
                        ?>
                        <div class="blog__item  swiper-slide fix">
                           <div class="blog__thumb" data-background="<?php the_post_thumbnail_url( $post->ID, $settings['thumbnail_size'] );?>"></div>

                           <div class="blog__content">
                                 <div class="blog__meta">
                                    <div class="blog__author">
                                       <i class="fal fa-calendar-alt"></i>
                                       <span><?php the_time( get_option('date_format') ); ?></span>
                                    </div>
                                    <div class="blog__catagory">
                                       <span><?php echo esc_html($categories[0]->name); ?></span>
                                    </div>
                                 </div>

                                 <h5 class="blog__sm-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h5>

                                <?php if (!empty($settings['tp_post_content'])):
                                    $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                    ?>
                                    <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_post_btn'])) : ?>
                                 <div class="blog__btn mt-120">
                                    <a href="<?php the_permalink(); ?>" class="link-btn">
                                       <?php echo esc_html($settings['tp_post_btn']); ?><i class="fal fa-long-arrow-right"></i>
                                    </a>
                                 </div>
                                 <?php endif; ?>
                           </div>
                        </div>
                        <?php endwhile; wp_reset_query(); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php endif; ?>






      <?php endif; ?>


       <?php
	}

}

$widgets_manager->register( new TP_Blog_Post() );