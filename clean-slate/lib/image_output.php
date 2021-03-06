<?php
/***************************************************************
 * SET IMAGE ARRAY BASED ON SIZES
 ***************************************************************/
/*
 * TAKES ACF GALLERY or IMAGE INPUT AND PUTS IT INTO A IMAGE ARRAY
 * @image Image Array from ACF
 * $maxsize Largest Screen size you want returned.
 *      ex. if you want an image that is only 768 px wide enter 768
 * @imageClass style classes to be added directly to the image tag
 *
 * */
if(!function_exists('set_image_array')) {

    function set_image_array(array $imageData , $imageOverride ='')
    {
        if(empty($imageData['imageArray'])){return false;}

        $maxsize =( !empty( $imageData['maxSize'] ) )? $imageData['maxSize'] : 1920;

        $imageClass =( !empty( $imageData['imagesClass'] ) )? $imageData['imagesClass'] : '';

        if($imageData['singleImage'] == true){

            $images[0] = $imageData['imageArray'];
        }else {

            $images = $imageData['imageArray'];
        }
        foreach ($images as $key => $image) {

            $returnData[$key] = [
                'title' => !empty($image['title']) ? $image['title'] : $image['alt'],
                'alt' => !empty($image['alt']) ? $image['alt'] : $image['title'],
                'default' => $image['url'],
                'imgClass' => $imageClass
            ];


            if (!empty($imageOverride)) {
                $returnData[$key]['srcset'] = $imageOverride;
            } else {
                $img = $image['sizes'];
                if (!empty($img['2048x2048']) && $maxsize >= 1920) {
                    $returnData[$key]['srcset']['1920'] = $img['2048x2048'];
                }
                if (!empty($img['hero-default']) && $maxsize >= 1440) {
                    $returnData[$key]['srcset']['1440'] = $img['hero-default'];
                }

                if (!empty($img['hero-default']) && $maxsize >= 1280) {
                    $returnData[$key]['srcset']['1280'] = $img['hero-default'];
                }
                if (!empty($img['large']) && $maxsize >= 1024) {
                    $returnData[$key]['srcset']['1024'] = $img['large'];
                }
                if (!empty($img['medium_large']) && $maxsize >= 768) {
                    $returnData[$key]['srcset']['768'] = $img['medium_large'];
                }
                if (!empty($img['medium']) && $maxsize >= 360) {
                    $returnData[$key]['srcset']['360'] = $img['medium'];
                }
            }// IF End
        } // Foreach END

        return $returnData;
    }
}

/***************************************************************
 *  OUTPUT IMAGE ARRAY BASED ON SET IMAGE ARRAY RETURN
 ***************************************************************/

/*
 * Takes the output of set_image_array and outputs a picture tag
 * @imageArray The return from the set_image_array function
 * @class style classes to be added directly to the picture tag
 *      cover-picture added by default
 *  */
if(!function_exists('output_pictures')){

    function output_pictures ($imageArray, $class=''){

        if(!$imageArray){return false;}
        $imgPos = 1;
        foreach($imageArray as $key => $value){
            $prtClass = (!empty($class))? $class:'pic';?>
            <picture class="<?= $prtClass; ?> <?= "${prtClass}-{$imgPos}"; ?>">
                <?php
                //foreach ($value['srcset'] as $size => $source) {?>
                <!--  <source media="(min-width:<?php //echo $size; ?>px)" srcset="<?php //echo $source; ?>">
                --><?php //      // } // end Foreach
                ?>
                <img src="<?= $value['default'];?>"
                     alt="<?= $value['alt'];?>"
                     class="lazyload <?= $value['imgClass']; ?>"
                     title="<?= $value['title']?>"
                     draggable="false">
            </picture>
            <?php
            $imgPos++;
        } // End Foreach
    } // end If
}

if(!function_exists('get_defaults')){
  function get_defaults(){
    return array(
      0 => array(
        'title' => 'I Run Canada',
        'alt' => 'I Run Canada',
        'default' => 'https://iruncanada.com/wp-content/themes/clean-slate/img/mountains.jpg',
        'imgClass' => '',
        'srcset' => array (
          '0' => 'https://iruncanada.com/wp-content/themes/clean-slate/img/mountains.jpg'
          )
        )
    );
  }
}
