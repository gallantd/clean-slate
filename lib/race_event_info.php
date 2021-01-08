<?php
/*
 * Get Race event details by post ID and return all values needed
 * */
if(!function_exists('getRaceEvent')) {
    function getRaceEvent($id)
    {
        return array (
            'img' => get_field('race_image', $id),
            'required' => get_field('required_gear', $id),
            'prov' => getProvince(get_field('province', $id)),
            'city' => get_field('city', $id),
            'address' => getAddress(get_field('province', $id), get_field('city', $id) ),
            'dist' => get_field('distance', $id),
            'elev' => get_field('elevation', $id),
            'color' => get_field('register_link', $id),
            'cost' => get_field('registration_cost', $id),
            'regLink' => get_field('register', $id),
            'site' => getSite(get_field('website', $id)),
            'cancelled' => get_field('is_cancelled', $id),
            'contact' => get_field('contact_info', $id),
            'date' => getSchedule($id),
            'time' => get_field('start_time', $id)

        );
    }
}

if(!function_exists('getSchedule')){
  function getSchedule($id){
    if(get_field('date_scheduled', $id)){
        return get_field('event_date', $id);
    } else {
      return 'coming soon';
    }
    return $data;
  }
}

if(!function_exists('getAddress')){
  function getAddress($prov, $city){
    return "{$city}, {$prov['label']}";
  }
}

if(!function_exists('getProvince')) {
    function getProvince($loc)
    {
        return $loc['label'];
    }
}

if(!function_exists('getSite')) {
    function getSite($site)
    {
      if(empty($site)){return false;}
        return '<a href="'.$site['url'].'" class="text-link" target="_blank">'.$site['title'].'</a>';

    }
}
