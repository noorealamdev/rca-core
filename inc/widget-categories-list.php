<?php

function rca_categories_list_register_widget() {
    register_widget( 'rca_categories_list_widget' );
}
add_action( 'widgets_init', 'rca_categories_list_register_widget' );

class rca_categories_list_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
        // widget ID
            'rca_categories_list_widget',
            // widget name
            __( '[RCA] Categories List Widget', ' hstngr_widget_domain' ),
            // widget description
            array(
                'description' => __( 'Display categories list', 'hstngr_widget_domain' ),
                'classname' => 'rca_categories_list_widget'
            )
        );
    }

    public function widget( $args, $instance ) { ?>

        <div class="influex-category-browser">
            <div class="influex-category-browser-wrapper"><h3>Browse By Category</h3>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/chess-openings/" class=""><i class="fas fa-chess"></i> Chess
                        Openings</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/chess-middlegame/" class=""><i class="fal fa-game-board"></i>
                        Chess Middlegame</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/chess-endgame/" class=""><i class="far fa-chess-clock"></i>
                        Chess Endgame</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/chess-strategy/" class=""><i class="fas fa-tasks"></i> Strategy</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/training-and-psychology/" class=""><i
                            class="far fa-analytics"></i> Training & Psychology</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/news/" class=""><i class="fas fa-newspaper"></i> News & Products</a>
                </div>
                <div class="category-item">
                    <a href="https://chess-teacher.com/category/other-topics/" class=""><i class="fad fa-chess-king"></i> Other
                        Topics</a>
                </div>
            </div>
        </div>

    <?php }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance          = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}