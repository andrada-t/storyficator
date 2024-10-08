<?php
if( !function_exists('storyfi_carousel_shortcode') ) {
  function storyfi_carousel_shortcode($atts) {

      $query_args = array(
          'post_type' => 'storyfi',
          'id '       => $atts['post_id'],
          'name'      => $atts['post_name']
      );
      $query = new WP_Query($query_args);
      ob_start(); 

      $storyfi_carousel_group = get_post_meta($atts['post_id'], 'storyfi_carousel_group', true); ?>

      <div class="story-bubbles">
        <div class="bubbles" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'> <?php
          foreach (array_reverse($storyfi_carousel_group) as $storyfi_carousel_item) {
            if(!empty($storyfi_carousel_item['storyfi_carousel_title'])) {
              $storyfi_carousel_title = $storyfi_carousel_item['storyfi_carousel_title'];
            } else {
              $storyfi_carousel_title = esc_html__('Item','storyfi');
            } ?>
            <div class="bubble carousel-cell">
              <a href="#storyfi-modal">
                <div class="thumb">
                  <img src="<?php echo esc_url($storyfi_carousel_item['storyfi_carousel_img']); ?>" alt="">
                </div>
                <div class="text">
                    <span><?php echo esc_html($storyfi_carousel_title); ?></span>
                </div>
              </a>
            </div><?php
          } ?>
        </div>
        <div class="bubbles readon"></div>
      </div>
      
      <div id="storyfi-modal">
        <span class="close">&times;</span>
        <div class="story-container carousel-main">
          <?php
          foreach (array_reverse($storyfi_carousel_group) as $storyfi_carousel_item) { ?>
            <div class="story-item">
              <div class="indicator">
                <div class="slider-progress">
                  <span class="progress"></span>
                </div>
              </div>
              <img src="<?php echo esc_url($storyfi_carousel_item['storyfi_carousel_img']); ?>">
            </div>
          <?php } ?>
        </div>
      </div>
      <?php
      // Restore original post data
      return ob_get_clean();
  }
  add_shortcode('storyfi_shortcode', 'storyfi_carousel_shortcode');
}


add_action('transition_post_status', 'storify_post_meta_on_publish', 10, 3);
function storify_post_meta_on_publish($new_status, $old_status, $post) {
    if ($post->post_type === 'storyfi' && $new_status === 'publish' && $old_status !== 'publish') {
        $post_id = $post->ID;
        $post_title = get_the_title($post_id);
        $meta_key = 'storify_shortcode_value';
        $meta_value = '[storyfi_shortcode post_name="'.$post_title.'" post_id="'.get_the_id().'"]';

        update_post_meta($post_id, $meta_key, $meta_value);
    }
}