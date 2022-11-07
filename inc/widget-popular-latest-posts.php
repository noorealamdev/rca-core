<?php

function rca_popular_latest_tab_register_widget()
{
    register_widget('rca_popular_latest_tab_widget');
}

add_action('widgets_init', 'rca_popular_latest_tab_register_widget');

class rca_popular_latest_tab_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
        // widget ID
            'rca_popular_latest_tab_widget',
            // widget name
            __('[RCA] Popular/Latest Widget', ' hstngr_widget_domain'),
            // widget description
            array(
                'description' => __('Display popular/latest blog posts tab', 'hstngr_widget_domain'),
                'classname' => 'rca_popular_latest_tab_widget'
            )
        );
    }

    public function widget($args, $instance)
    {

	    $post_ids = array( 44649, 44913, 42641, 35203 );

	    $popular_query_args = [
		    'post_type' => 'post',
		    'posts_per_page' => 5,
		    'no_found_rows' => true,
		    "post_status" => "publish",
		    "meta_key" => "views",
		    "orderby" => "meta_value_num"
	    ];

        $latest_query_args = [
            'post_type' => 'post',
            "post_status" => "publish",
            'posts_per_page' => 5,
            'no_found_rows' => true,
            "order" => "DESC"
        ];

        $popular_posts_query = new WP_Query($popular_query_args);
        $latest_posts_query = new WP_Query($latest_query_args);
        ?>

        <!-- EKS-TABS.BEGIN -->
        <div class="eks-tabs">
            <!-- tabs inputs -->
            <input id="eks-tab-1" class="eks-tabs__input" type="radio" name="eksTab" checked>
            <input id="eks-tab-2" class="eks-tabs__input" type="radio" name="eksTab">
            <!-- tabs inputs -->

            <!-- tabs labels -->
            <div class="eks-tabs__labels">
                <label for="eks-tab-1" class="eks-tabs__label"><span class="eks-tabs__label-inner">Popular</span></label>
                <label for="eks-tab-2" class="eks-tabs__label"><span class="eks-tabs__label-inner">Latest</span></label>
            </div>
            <!-- tabs labels -->

            <!-- tab-contents -->
            <div class="eks-tabs__contents">
                <!-- content#1 -->
                <div id="eks-tabs__content-1" class="eks-tabs__content">
                    <div class="widget edumall-wp-widget-posts">
                        <div class="post-list edumall-animation-zoom-in">
                            <?php while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post(); ?>
                                <?php
                                $classes = array('post-item edumall-box');
                                ?>
                                <div <?php post_class(implode(' ', $classes)); ?> >
                                    <div class="post-widget-thumbnail edumall-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <?php Edumall_Image::the_post_thumbnail(['size' => '100x80']); ?>
                                                <?php
                                            } else {
                                                Edumall_Templates::image_placeholder(100, 80);
                                            }
                                            ?>
                                            <?php Edumall_Post::instance()->the_category([
                                                'classes' => 'post-widget-overlay-categories',
                                                'show_links' => false,
                                            ]); ?>
                                        </a>
                                    </div>
                                    <div class="post-widget-info">
                                        <h5 class="post-widget-title">
                                            <a href="<?php the_permalink(); ?>" class="link-in-title"><?php the_title(); ?></a>
                                        </h5>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div><!-- content#1 -->

                <!-- content#2 -->
                <div id="eks-tabs__content-2" class="eks-tabs__content">
                    <div class="widget edumall-wp-widget-posts">
                        <div class="post-list edumall-animation-zoom-in">
                            <?php while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post(); ?>
                                <?php
                                $classes = array('post-item edumall-box');
                                ?>
                                <div <?php post_class(implode(' ', $classes)); ?> >
                                    <div class="post-widget-thumbnail edumall-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <?php Edumall_Image::the_post_thumbnail(['size' => '100x80']); ?>
                                                <?php
                                            } else {
                                                Edumall_Templates::image_placeholder(100, 80);
                                            }
                                            ?>
                                            <?php Edumall_Post::instance()->the_category([
                                                'classes' => 'post-widget-overlay-categories',
                                                'show_links' => false,
                                            ]); ?>
                                        </a>
                                    </div>
                                    <div class="post-widget-info">
                                        <h5 class="post-widget-title">
                                            <a href="<?php the_permalink(); ?>" class="link-in-title"><?php the_title(); ?></a>
                                        </h5>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div><!-- content#3 -->

            </div><!-- tab-contents -->
        </div><!-- EKS-TABS.END -->

    <?php }

    public function form($instance)
    {
        if (isset($instance['title']))
            $title = $instance['title'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}