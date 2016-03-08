<?php
/**
 * Template for displaying search forms in Cybernauci
 *
 * @package WordPress
 * @subpackage Cybernauci
 * @since Cybernauci 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'cybernauci'); ?></span>
        <input type="search" class="search-field"
               placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'cybernauci'); ?>"
               value="<?php echo get_search_query(); ?>" name="s"
               title="<?php echo esc_attr_x('Search for:', 'label', 'cybernauci'); ?>"/>
    </label>
    <button type="submit" class="search-submit"><span
            class="screen-reader-text"><?php echo _x('Search', 'submit button', 'cybernauci'); ?></span></button>
</form>
