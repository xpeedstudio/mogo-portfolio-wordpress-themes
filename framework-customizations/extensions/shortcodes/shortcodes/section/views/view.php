<?php
if (!defined('FW')) {
    die('Forbidden');
}
$bg_color = $bg_image = $section_extra_classes = $bg_video_data_attr = $overlay = $space = $data_height= $extra_height= $height='';
$id = uniqid('section-');


$spacing = $atts['default_spacing'];
if ($spacing == 'yes') {
    $space = 'sections';
}

$bg_options = $atts['background_options']['background'];
if ($bg_options == 'color') {
    $bg_color = 'background-color:' . $atts['background_options']['color']['background_color'] . ';';
}



if ($bg_options == 'image') {
    $bg_image = 'background:url(' . esc_url($atts['background_options']['image']['background_image']['data']['icon']) . ') no-repeat center top fixed;-moz-background-size: cover;background-size: cover;-webkit-background-size: cover;-o-background-size: cover;width: 100%;';
    $section_extra_classes = 'parallax-section';

        $overlays = $atts['background_options']['image']['tab_item']['overlay11']['background'];
        $overlay11 = "style='background-color:$overlays'";

        $gradient11 = 'class = "all_overlay"';
        
        $style = $atts['background_options']['image']['tab_item']['selected_value'];
        if($style == 'overlay11'){
             $overlay =  $overlay11;
           
        }
        elseif($style == 'gradient11'){
            $overlay =  $gradient11;
        }
        else{
            echo 'Not Defined !';
        }
        
      
}


if ($bg_options == 'video') {
    $filetype = wp_check_filetype($atts['background_options']['video']['video']);
    $filetypes = array('mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster');
    $filetype = array_key_exists((string) $filetype['ext'], $filetypes) ? $filetypes[$filetype['ext']] : 'video';
    $bg_video_data_attr = 'data-wallpaper-options="' . fw_htmlspecialchars(json_encode(array('source' => array($filetype => $atts['background_options']['video']['video'])))) . '"';
    $section_extra_classes .= ' background-video';
    $overlays = $atts['background_options']['video']['overlay_options']['yes']['background'];
    $overlay = "style='background-color:$overlays;z-index:3;position:relative;'";
}

if ($atts['height'] != 'auto' && $atts['height'] != 'fw-section-height-sm' && $atts['height'] != 'fw-section-height-md' && $atts['height'] != 'fw-section-height-lg') {
    
    $height = (int) $atts['height'];
    $extra_height = 'height: ' . $height . 'px; line-height: ' . $height . 'px;';
} else {
    $height_classes = ' ' . $atts['height'];
}

//$section_style = ( $bg_color || $bg_image ) ? 'style="' . $bg_color . $bg_image . '"' : '';
$container_class = ( isset($atts['is_fullwidth']) && $atts['is_fullwidth'] ) ? 'fw-container-fluid' : 'fw-container';

$custom_class = $atts['class'];
?>

<section  id="<?php echo  $id; ?>" class="fw-main-row <?php echo esc_attr($section_extra_classes) ?> <?php echo  $height_classes ?> <?php echo  esc_attr($custom_class); ?>"  style="<?php echo  $bg_color; ?> <?php echo  $bg_image; ?> <?php echo  $extra_height; ?>" <?php echo  $bg_video_data_attr; ?> >
    <div <?php echo $overlay; ?>>
        <div class="<?php echo  $container_class; ?> <?php echo  $space ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</section>
