<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Pricing extends Widget_Base {

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
		return 'tp-pricing';
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
		return __( 'Pricing', 'tpcore' );
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


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
            'active_price',
            [
                'label' => __('Active Price', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,

            ]
        );

        $this->add_control(
            'border_visible',
            [
                'label' => __('Border Box ?', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->end_controls_section();

        // _tp_icon
        $this->start_controls_section(
            '_tp_icon',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-10'
                ]
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

        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Header', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Basic', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Sub Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'tp_design_style' => ['layout-10'],
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('description', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __('Pricing', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'bdevs-element'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'bdevs-element'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'bdevs-element'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'bdevs-element'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'bdevs-element'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'bdevs-element'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'bdevs-element'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'bdevs-element'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'bdevs-element'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'bdevs-element'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'bdevs-element'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'bdevs-element'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'bdevs-element'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'bdevs-element'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'bdevs-element'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'bdevs-element'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'bdevs-element'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'bdevs-element'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'bdevs-element'),
                    'custom' => __('Custom', 'bdevs-element'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features',
            [
                'label' => __('Features', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'features_switch',
            [
                'label' => __('Show', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'feature_description',
            [
                'label' => __('Feature Description', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __('description', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'tp_feature_unavailable',
            [
                'label' => __('Feature Hide ?', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'bdevs-element'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fal fa-check',
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
                [
                    'show_label' => true,
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => [
                        'value' => 'fal fa-check',
                        'library' => 'fa-solid',
                    ]
                ]
            );
        }
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => __('Standard Feature', 'bdevs-element'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Another Great Feature', 'bdevs-element'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Obsolete Feature', 'bdevs-element'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => __('Exciting Feature', 'bdevs-element'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print((text)); #>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_badge',
            [
                'label' => __('Badge', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __('Show', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label' => __('Position', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'style_transfer' => true,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Recommended', 'bdevs-element'),
                'placeholder' => __('Type badge text', 'bdevs-element'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
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

	}

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
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
	        if ($settings['currency'] === 'custom') {
	            $currency = $settings['currency_custom'];
	        } else {
	            $currency = self::get_currency_symbol($settings['currency']);
	        }
		?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'sponsorsTitle__heading text-uppercase');


            $active_class_name = $settings['active_price'] ? 'pricing__item-3-active' : '';
            $border_visible = $settings['border_visible'] ? '' : 'pricing__item-3-df';


            $btn_class_name = $active_class_name ? 'tp-btn-4-active w-100' : 'tp-btn-4 w-100';
            $more_class_name = $active_class_name ? 'more-option-active' : 'more-option';

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-9 tp-btn-12 w-100');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-9 tp-btn-12 w-100');
                }
            }

        ?>
          <div class="pricing__item-3 <?php echo esc_attr($active_class_name); ?> <?php echo esc_attr($border_visible); ?> mb-30">
                <div class="sm-content sm-content-1">
                   <div class="sm-content-name">
                      <?php if ($settings['price']) : ?>
                      <h5><?php echo esc_html($currency); ?><?php echo tp_kses($settings['price']); ?></h5>
                      <?php endif; ?>

                      <?php if ($settings['price']) : ?>
                      <span>/<?php echo tp_kses($settings['period']); ?></span>
                      <?php endif; ?>

                   </div>
                    <?php if ($settings['description']) : ?>
                        <p class="pr-text mb-30"><?php echo tp_kses($settings['description']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_button_show'])) : ?>
                   <a href="<?php echo esc_url($settings['tp_btn_link']); ?>" class="<?php echo esc_attr($btn_class_name); ?>"><?php echo $settings['tp_btn_text']; ?></a>
                   <?php endif; ?>

                </div>

              <?php if (!empty($settings['features_switch'])) : ?>
               <div class="sm-content">
                  <ul>
                    <?php foreach ($settings['features_list'] as $index => $item) :
                        $availability = !empty($item['tp_feature_unavailable']) ? 'disable' : 'price-available';
                    ?>
                     <li class="<?php echo esc_attr($availability); ?>"><?php echo tp_kses($item['text']); ?> <span><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span></li>
                    <?php endforeach; ?>
                  </ul>
                  <?php if ($settings['feature_description']) : ?>
                  <div class="<?php echo esc_attr($more_class_name); ?> mt-25 text-center">
                      <span><?php echo tp_kses($settings['feature_description']); ?></span>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
          </div>


        <?php else: 
            $this->add_render_attribute('title', 'class', 'section__title');

            $active_class_name = $settings['active_price'] ? 'pricing__item-active' : '';
            $btn_class_name = $active_class_name ? 'tp-btn-df-active' : 'tp-btn-df';

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-9 tp-btn-12 w-100');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-9 tp-btn-12 w-100');
                }
            }
        ?>  
        <div class="pricing__item <?php echo esc_attr($active_class_name); ?> text-center mb-30">
            <?php if ( !empty($settings['show_badge']) ) : ?>
            <div class="badge-price">
                <span><?php echo esc_html($settings['badge_text']); ?></span>
            </div>
            <?php endif; ?>

           <div class="pricing__item-name mb-5">
              <?php if ($settings['title']) : ?>
              <h5><?php echo tp_kses($settings['title']); ?></h5>
              <?php endif; ?>

            <?php if ($settings['description']) : ?>
                <p class="mb-15"><?php echo tp_kses($settings['description']); ?></p>
            <?php endif; ?>
           </div>

           <?php if ($settings['period']) : ?>
           <div class="pricing__item-info mb-50">
              <h5><?php echo tp_kses($settings['period']); ?></h5>
           </div>
           <?php endif; ?>

           <div class="pricing__item-price mb-30">
              <?php if ($settings['price']) : ?>
              <span><?php echo esc_html($currency); ?><?php echo tp_kses($settings['price']); ?></span>
              <?php endif; ?>

               <?php if ($settings['feature_description']) : ?>
              <p><?php echo tp_kses($settings['feature_description']); ?></p>
              <?php endif; ?>

              <?php if (!empty($settings['features_switch'])) : ?>
               <div class="price__list mb-35">
                  <ul>
                    <?php foreach ($settings['features_list'] as $index => $item) :
                        $availability = $item['tp_feature_unavailable'] ? 'unavailable' : 'price-available';
                    ?>
                     <li class="<?php echo esc_attr($availability); ?>"><?php echo tp_kses($item['text']); ?> <span><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span></li>
                    <?php endforeach; ?>
                  </ul>
               </div>
               <?php endif; ?>

           </div>
           <?php if (!empty($settings['tp_btn_button_show'])) : ?>
           <div class="pricing__item-button">
              <a href="<?php echo esc_url($settings['tp_btn_link']); ?>" class="<?php echo esc_attr($btn_class_name); ?>"><?php echo $settings['tp_btn_text']; ?> <i class="fal fa-long-arrow-right"></i></a>
           </div>
           <?php endif; ?>
        </div>
        <?php endif; ?>


        <?php
	}

}

$widgets_manager->register( new TP_Pricing() );