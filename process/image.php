<?php
function get_image() {
    $image = array();
    
    $query = mysql_query("SELECT 'image_id', 'caption', 'image_likes' FROM 'image'");
    while (($row = mysql_fetch_assoc($query)) !== false) {
        echo $row['caption'], '<br />';
    }
}
?>