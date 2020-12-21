<?php
/***************************************************************
 * PHP INCLUDES
 ***************************************************************/

require_once locate_template("lib/race_event_info.php");
require_once locate_template("lib/post_listing.php");
require_once locate_template("lib/image_output.php");


add_action('wp_head', function(){
    print('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>');
});
function cleanSlateBase() {
    wp_enqueue_script( 'my-great-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '2.2.4',
        true );
    wp_enqueue_style( 'slider', get_template_directory_uri() . '/css/style.css',false,'1.1','all');
}
add_action( 'wp_enqueue_scripts', 'cleanSlateBase' );

if(!function_exists('promoRaceEvent')){
    function defaultRaceEvent(){
        echo "Promo";
    }
}

if(!function_exists('displayTicker')){
   function displayTicker($values, $type = 'province'){
       if(empty($values)){ return false; }
       $count = count($values);?>
       <section class="ticker ticker--<?= $count; ?>">
           <?php foreach ($values as $value){?>
               <a href="http://localhost:8888/irc/race-list?<?= $type; ?>=<?= $value; ?>" class="ticker--value"><?= $value; ?></a>
           <?php }// end foreach?>
       </section>
<?php
   }//end function
}//end if
