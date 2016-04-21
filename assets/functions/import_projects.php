<?php
function exchange_importer() {
  $result = array();
  $args = array(
    'post_type' => 'participant',
    'posts_per_page' => -1,
    'post_status' => 'draft'

  );
  $collab_args = array(
    'post_type' => 'collaboration',
    'posts_per_page' => 1,
    'post_status' => 'draft',
    'meta_key' => 'collaboration_id',
    'fields' => 'ids'
  );
  $query = new WP_Query($args);
  $participants = $query->posts;
  if(!empty($participants)) {
    foreach($participants as $participant) {
      // lookup collab ID
      $cid = get_field('collaboration_id', $participant->ID);
      // set as metavalue
      $collab_args['meta_value'] = $cid;
      // create new query with this metavalue
      $collab_query = new WP_Query($collab_args);
      // result is collab_post_id;
      $collab = $collab_query->posts[0];
      // get relationship data from collab post
      $party = get_field('participants',$collab,false);
      if (!empty($party)) {
        array_push($party,$participant->ID);
      }
      else {
        $party[0] = $participant->ID;
      }
      update_field('field_56b9b7c755a9f', $party, $collab);
      $result['collab_post_id: '.$collab]['participants1'] = get_field('participants',$collab,false);
      $result['collab_post_id: '.$collab]['title'] = get_the_title($collab);
      $result['collab_post_id: '.$collab]['collab_id'] = $cid;
      $result['collab_post_id: '.$collab]['participants2'] = $party;
    }
  }
  else {
    $result[0] = "No participants found";
  }
  return $result;
}
