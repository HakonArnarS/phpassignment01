<?php
function get_checked($field_name)
{
    global $post_categories;
    if (in_array($field_name, $post_categories)) {
        echo 'checked';
    }
}
