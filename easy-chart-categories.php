<?php
/*
Plugin Name: Easy Chart Categories
Plugin URI: https://github.com/moneypenny/Easy-Chart-Categories
Description: Wordpress plugin making use of the Easy Chart Builder plugin to display charts of your categories and tags.  Requires Easy Chart Builder plugin <http://wordpress.org/extend/plugins/easy-chart-builder/>; tested with version 1.2.
Version: 0.1
Author: Sarah Vessels
Author URI: http://www.3till7.net/
License: GPL2
*/
/*  Copyright 2012  Sarah Vessels  (email : cheshire137@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode('easychart_categories', 'easychartcategories_shortcode');
add_shortcode('easychart_tags', 'easycharttags_shortcode');

function easychartcategories_shortcode($atts, $content=NULL) {
    $def_colors = '5E0D5C,C40B49,FF2E0C,FF990A,90B207,0ABD9C,38C1F5,004DD0,' .
        'AF33C8,FF7EAB,B77087,828282';
    extract(shortcode_atts(array(
        'charttype'=>'pie',
        'height'=>'200',
        'width'=>'200',
        'title'=>'Categories',
        'imagealtattr'=>'Categories chart',
        'groupcolors'=>$def_colors,
        'hidechartdata'=>'true',
        'showcounts'=>'true',
        'chartcolor'=>'FFFFFF',
        'chartfadecolor'=>'FFFFFF',
        'datatablecss'=>'',
        'imgstyle'=>'',
        'axis'=>'none',
        'grid'=>'false',
        'child_of'=>0,
        'parent'=>'',
        'orderby'=>'count',
        'order'=>'DESC',
        'hide_empty'=>1,
        'hierarchical'=>1,
        'number'=>'',
        'taxonomies'=>'category',
        'pad_counts'=>false,
        'get'=>'',
        'search'=>'',
        'name__like'=>'',
        'slug'=>'',
        'offset'=>''
    ), $atts));
    // Easy Chart Builder allows up to 12 groups in a chart
    $number = ('' == $number || $number > 12) ? 12 : $number;
    $term_args = array('child_of'=>$child_of,'parent'=>$parent,'slug'=>$slug,
        'orderby'=>$orderby,'order'=>$order,'hide_empty'=>$hide_empty,
        'hierarchical'=>$hierarchical,'get'=>$get,'search'=>$search,
        'number'=>$number,'pad_counts'=>$pad_counts,'name__like'=>$name__like,
        'offset'=>$offset);
    $terms = get_terms($taxonomies, $term_args);
    $showcounts = 'true' == strtolower($showcounts);
    $group_names = array();
    $group_values = array();
    foreach ($terms as $index => $term) {
        $group_name = $term->name;
        if ($showcounts) {
            $group_name .= ' (' . $term->count . ')';
        }
        $group_names[] = $group_name;
        $group_values[] = 'group' . ($index + 1) . 'values="' . $term->count . '"';
    }
    $group_names = implode(',', $group_names);
    $group_values = implode(' ', $group_values);
    return do_shortcode('[easychart title="' . $title . '" type="' . $charttype . '" groupnames="' .
        $group_names . '" ' . $group_values . ' chartfadecolor="' . $chartfadecolor .
        '" hidechartdata="' . $hidechartdata . '" height="' . $height . '" width="' .
        $width . '" groupcolors="' . $groupcolors . '" datatablecss="' . $datatablecss .
        '" imgstyle="' . $imgstyle . '" axis="' . $axis . '" grid="' . $grid .
        '" imagealtattr="' . $imagealtattr . '" chartcolor="' . $chartcolor . '"]');
}

function easycharttags_shortcode($atts, $content=NULL) {
    return easychartcategories_shortcode(array(
        'taxonomies'=>'post_tag',
        'title'=>'Tags',
        'imagealtattr'=>'Tags chart'
    ));
}
?>
