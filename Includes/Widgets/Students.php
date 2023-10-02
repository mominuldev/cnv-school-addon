<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\{Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Repeater
};

/**
 * Class Accordion
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class Students extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Accordion widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-students';
	}


	/**
	 * Get widget title.
	 * Retrieve Accordion widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Students Chart', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Accordion widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-line-chart';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	/**
	 * Retrieve the list of keywords the widget belongs to.
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */

	public function get_keywords() {
		return [ 'accordion', 'cnv', 'cnv' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Content', 'cnv-school-addon' ),
		] );

		$repeater = new Repeater();

		$repeater->add_control(
			'class_name',
			[
				'label' => __( 'Class Name', 'text-domain' ),
				'type'  => Controls_Manager::TEXT,
			]
		);


		$repeater->start_controls_tabs(
			'style_tabs'
		);

		$repeater->start_controls_tab(
			'section_name_a_tab',
			[
				'label' => esc_html__( 'Sec A', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'section_name_a',
			[
				'label' => __( 'Section Name', 'text-domain' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'male_count_a',
			[
				'label' => __( 'Male Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'female_count_a',
			[
				'label' => __( 'Female Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'section_name_b_tab',
			[
				'label' => esc_html__( 'Sec B', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'section_name_b',
			[
				'label' => __( 'Section Name', 'text-domain' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'male_count_b',
			[
				'label' => __( 'Male Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'female_count_b',
			[
				'label' => __( 'Female Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->end_controls_tab();

		// Section C
		// ==================
		$repeater->start_controls_tab(
			'section_name_c_tab',
			[
				'label' => esc_html__( 'Sec C', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'section_name_c',
			[
				'label' => __( 'Section Name', 'text-domain' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'male_count_c',
			[
				'label' => __( 'Male Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'female_count_c',
			[
				'label' => __( 'Female Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->end_controls_tab();

		// Section D
		// ==================

		$repeater->start_controls_tab(
			'section_name_d_tab',
			[
				'label' => esc_html__( 'Sec D', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'section_name_d',
			[
				'label' => __( 'Section Name', 'text-domain' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'male_count_d',
			[
				'label' => __( 'Male Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'female_count_d',
			[
				'label' => __( 'Female Student', 'text-domain' ),
				'type'  => Controls_Manager::NUMBER,
			]
		);
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();


		$this->add_control(
			'sections',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ class_name }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['sections'] ) ) {

			$overallTotal = 0;
			$overallTotalMale = 0;
			$overallTotalFemale = 0;


			?>
            <div class="cnv-student-chart">
                <div class="cnv-student-chart__header">
                    <div class="cnv-student-chart__header-item">
                        <h4 class="cnv-student-chart__header-item__label"><?php echo esc_html__( 'Class', 'cnv-school-addon' ) ?></h4>
                    </div>
                    <div class="cnv-student-chart__header-item">
                        <h4 class="cnv-student-chart__header-item__label"><?php echo esc_html__( 'Section', 'cnv-school-addon' ) ?></h4>
                    </div>
                    <div class="cnv-student-chart__header-item">
                        <h4 class="cnv-student-chart__header-item__label"><?php echo esc_html__( 'Male', 'cnv-school-addon' ) ?></h4>
                    </div>
                    <div class="cnv-student-chart__header-item">
                        <h4 class="cnv-student-chart__header-item__label"><?php echo esc_html__( 'Female', 'cnv-school-addon' ) ?></h4>
                    </div>
                    <div class="cnv-student-chart__header-item">
                        <h4 class="cnv-student-chart__header-item__label"><?php echo esc_html__( 'Total', 'cnv-school-addon' ) ?></h4>
                    </div>
                </div>

                <div class="cnv-student-chart__body">
					<?php foreach ( $settings['sections'] as $section ) :

						$class = ! empty( $section['class_name'] ) ? $section['class_name'] : '';
						$sectionName = ! empty( $section['section_name_a'] ) ? $section['section_name_a'] : '';
						$maleCount = isset( $section['male_count_a'] ) ? intval( $section['male_count_a'] ) : 0;
						$femaleCount = isset( $section['female_count_a'] ) ? intval( $section['female_count_a'] ) : 0;

						// Section B
						// ==================
						$sectionName_B = ! empty( $section['section_name_b'] ) ? $section['section_name_b'] : '';
						$maleCount_B   = isset( $section['male_count_b'] ) ? intval( $section['male_count_b'] ) : 0;
						$femaleCount_B = isset( $section['female_count_b'] ) ? intval( $section['female_count_b'] ) : 0;

						// Section C
						// ==================
						$sectionName_C = ! empty( $section['section_name_c'] ) ? $section['section_name_c'] : '';
						$maleCount_C   = isset( $section['male_count_c'] ) ? intval( $section['male_count_c'] ) : 0;
						$femaleCount_C = isset( $section['female_count_c'] ) ? intval( $section['female_count_c'] ) : 0;

						// Section D
						// ==================
						$sectionName_D = ! empty( $section['section_name_d'] ) ? $section['section_name_d'] : '';
						$maleCount_D   = isset( $section['male_count_d'] ) ? intval( $section['male_count_d'] ) : 0;
						$femaleCount_D = isset( $section['female_count_d'] ) ? intval( $section['female_count_d'] ) : 0;


						// All Sections Total
						$total_A        = $maleCount + $femaleCount;
						$total_B        = $maleCount_B + $femaleCount_B;
						$total_C        = $maleCount_C + $femaleCount_C;
						$total_D        = $maleCount_D + $femaleCount_D;
						$total        = $total_A + $total_B + $total_C + $total_D;

						// All Section Male Total
						$maleTotal        = $maleCount + $maleCount_B + $maleCount_C + $maleCount_D;

						// All Section Female Total
						$femaleTotal        = $femaleCount + $femaleCount_B + $femaleCount_C + $femaleCount_D;

						// All Sections Total Male
						$overallTotalMale  += $maleTotal;

						// All Sections Total Female
						$overallTotalFemale  += $femaleTotal;



						$overallTotal += $total;

						?>
                        <div class="cnv-student-chart__class-info">
							<?php if ( ! empty( $class ) ) : ?>
                                <div class="cnv-student-chart__class">
									<?php echo esc_html( $class ); ?>
                                </div>
							<?php endif; ?>
                            <div class="cnv-student-chart__students-list">
								<?php if ( $sectionName || $maleCount || $femaleCount ) : ?>
                                    <div class="cnv-student-chart__students">
                                        <div class="cnv-student-chart__section">
											<?php echo esc_html( $sectionName ); ?>
                                        </div>
                                        <div class="cnv-student-chart__male">
											<?php echo esc_html( $maleCount ); ?>
                                        </div>
                                        <div class="cnv-student-chart__female">
											<?php echo esc_html( $femaleCount ); ?>
                                        </div>
                                    </div>
								<?php endif; ?>

								<?php if ( $sectionName_B || $maleCount_B || $femaleCount_B ) : ?>
                                    <div class="cnv-student-chart__students">
                                        <div class="cnv-student-chart__section">
											<?php echo esc_html( $sectionName_B ); ?>
                                        </div>
                                        <div class="cnv-student-chart__male">
											<?php echo esc_html( $maleCount_B ); ?>
                                        </div>
                                        <div class="cnv-student-chart__female">
											<?php echo esc_html( $femaleCount_B ); ?>
                                        </div>
                                    </div>
								<?php endif; ?>

								<?php if ( $sectionName_C || $maleCount_C || $femaleCount_C ) : ?>
                                    <div class="cnv-student-chart__students">
                                        <div class="cnv-student-chart__section">
											<?php echo esc_html( $sectionName_C ); ?>
                                        </div>
                                        <div class="cnv-student-chart__male">
											<?php echo esc_html( $maleCount_C ); ?>
                                        </div>
                                        <div class="cnv-student-chart__female">
											<?php echo esc_html( $femaleCount_C ); ?>
                                        </div>
                                    </div>
								<?php endif; ?>

								<?php if ( $sectionName_D || $maleCount_D || $femaleCount_D ) : ?>
                                    <div class="cnv-student-chart__students">
                                        <div class="cnv-student-chart__section">
											<?php echo esc_html( $sectionName_D ); ?>
                                        </div>
                                        <div class="cnv-student-chart__male">
											<?php echo esc_html( $maleCount_D ); ?>
                                        </div>
                                        <div class="cnv-student-chart__female">
											<?php echo esc_html( $femaleCount_D ); ?>
                                        </div>
                                    </div>
								<?php endif; ?>

	                            <?php if ( $maleTotal !== 0 || $femaleTotal !== 0  ) : ?>
		                            <div class="cnv-student-chart__students total-students">
			                            <div class="cnv-student-chart__section">
				                            <?php echo esc_html__( 'Class Total:' ); ?>
			                            </div>
			                            <div class="cnv-student-chart__male">
				                            <?php echo esc_html( $maleTotal ); ?>
			                            </div>
			                            <div class="cnv-student-chart__female">
				                            <?php echo esc_html( $femaleTotal ); ?>
			                            </div>
		                            </div>
	                            <?php endif; ?>

                            </div>

							<?php if ( ! empty( $total ) ) : ?>
                                <div class="cnv-student-chart__total-student">
									<?php echo esc_html( $total ); ?>
                                </div>
							<?php endif; ?>
                        </div>
					<?php endforeach; ?>
	                <div class="cnv-student-chart__class-info cnv-student-chart__footer">
		                <div class="cnv-student-chart__class">

		                </div>
		                <div class="cnv-student-chart__students-list">
			                <div class="cnv-student-chart__students">
				                <div class="cnv-student-chart__section">
					                <span><?php echo esc_html__( 'Total Students:' ); ?></span>
				                </div>
				                <div class="cnv-student-chart__male">
					                <?php echo esc_html( $overallTotalMale ); ?>
				                </div>
				                <div class="cnv-student-chart__female">
					                <?php echo esc_html( $overallTotalFemale ); ?>
				                </div>
			                </div>
		                </div>
		                <div class="cnv-student-chart__total-student">
			                <?php echo esc_html( $overallTotal ); ?>
		                </div>
	                </div>
                </div>
            </div>
            <!-- /.cnv-student-chart -->
			<?php

		}
	}
}
