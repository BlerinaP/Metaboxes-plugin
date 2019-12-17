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

  function ga_metaboxes_container($post){
       wp_nonce_field(basename(__FILE__), "meta-box-nonce");
     ?>
    <div>
        <label for="input-metaboxes">Calories:</label>
        <input type="text" name="input-metabox" value="<?php echo get_post_meta($post->ID,"input-metabox", true);?>">
        <br/>

        <label for="textarea-metabox">Recipe short Description</label>
        <textarea name="textarea-metabox"><?php echo get_post_meta($post->ID,"textarea-metabox", true);?></textarea>
        <br/>

        <label for="dropdown-metabox">Rating:</label>
        <select name="dropdown-metabox">
            <?php
            $options = array(1,2,3,4,5);
            foreach($options as $key => $value){
                if($value ==  get_post_meta($post->ID,"dropdown-metabox", true)){
                    echo '<option selected>' . $value . '</option>';
                } else {
                   echo"<option value='{$value}'>{$value}</option>";
                }

            }
            ?>
        </select>
    </div>
<?php
}
   add_action('save_post', 'ga_save_metaboxes' );
   function ga_save_metaboxes($post_id){
      //Security
       if(!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
           return $post_id;

       if(!current_user_can("edit_post", $post_id))
           return $post_id;

       if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
           return $post_id;

       $input_metabox ='';
       $textarea_metabox ='';
       $dropdown_metabox ='';

       if(isset($_POST["input-metabox"])) {
           $input_metabox = $_POST["input-metabox"];
       }
       update_post_meta($post_id, "input-metabox", $input_metabox);

       if(isset($_POST["textarea-metabox"])) {
           $textarea_metabox = $_POST["textarea-metabox"];
       }
       update_post_meta($post_id, "textarea-metabox", $textarea_metabox);

       if(isset($_POST["dropdown-metabox"])) {
           $dropdown_metabox = $_POST["dropdown-metabox"];
       }
       update_post_meta($post_id, "dropdown-metabox", $dropdown_metabox);

   }
