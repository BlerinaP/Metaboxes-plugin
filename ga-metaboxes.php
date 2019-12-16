<?php
/*
 * Plugin Name: Gourmet Artist Metaboxes
 * Plugin Uri:
 * Description: Adds Metaboxes to the Gourmet Artistry Website
 * Version: 1.0
 * Author: Blerina
 * Author Uri:
 * License: GPL2
 * license Uri: https://www.gnu.ord/licenses/gpl2-0.0html
 */

  function ga_add_metaboxes(){
        add_meta_box('ga_metaboxes', 'Gourmet Artistry Metaboxes', 'ga_metaboxes_container', 'recipes', 'normal', 'high', null);
   }
    add_action('add_meta_boxes', 'ga_add_metaboxes');

  function ga_metaboxes_container(){
       echo "hello world";
   }