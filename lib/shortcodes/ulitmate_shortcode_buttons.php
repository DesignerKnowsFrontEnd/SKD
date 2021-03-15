<?php
function blue_button_call($atts, $content = null) {
    extract( shortcode_atts( array(
            'link' => '',
            'class' => '',
            'text' => '',
            'on_click' => '',
            'target' => ''
        ), $atts )
    );

    if(empty($atts['link'])){
        $atts['link'] = '';
    }

    if(empty($atts['class'])){
        $atts['class'] = '';
    }

    if(empty($atts['text'])){
        $atts['text'] = '';
    }
    if(empty($atts['on_click'])){
        $atts['on_click'] = '';
    }

    $output ="";
    if(empty($atts['target'])){
        $output .= '<a class="btn btn-blue  '.$atts['class'].'" href="'.$atts['link'].'" onclick="'.$atts['on_click'].'">';
    }
    else{
        $output .= '<a class="btn btn-blue  '.$atts['class'].'" href="'.$atts['link'].'" onclick="'.$atts['on_click'].'" target="'.$atts['target'].'" >';
    }
    $output .= $content;
    $output .= '</a>';

    return $output;
}

function trans_button_call($atts, $content = null) {
    extract( shortcode_atts( array(
            'link' => '',
            'class' => '',
            'text' => '',
            'on_click' => '',
            'target' => ''
        ), $atts )
    );

    if(empty($atts['link'])){
        $atts['link'] = '';
    }

    if(empty($atts['class'])){
        $atts['class'] = '';
    }

    if(empty($atts['text'])){
        $atts['text'] = '';
    }
    if(empty($atts['on_click'])){
        $atts['on_click'] = '';
    }

    $output ="";
    if(empty($atts['target'])){
        $output .= '<a class="btn btn-trans  '.$atts['class'].'" href="'.$atts['link'].'" onclick="'.$atts['on_click'].'">';
    }
    else{
        $output .= '<a class="btn btn-trans  '.$atts['class'].'" href="'.$atts['link'].'" onclick="'.$atts['on_click'].'" target="'.$atts['target'].'" >';
    }
    $output .= $content;
    $output .= '</a>';
    return $output;
}