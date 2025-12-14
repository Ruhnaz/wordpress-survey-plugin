<?php

$user_batch_id = get_user_meta( $userid->ID, '_batchid', false );
if(isset($user_batch_id[0])){ 
    $user_id= $user_batch_id[0];
    //echo  $user_batch_id;
  
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    
    $tblname = 'smp_survey_batch';
        $wp_track_table = $table_prefix . "$tblname";
        $que="SELECT * FROM {$wp_track_table} where batchid=$user_id";
       
        $result = $wpdb->get_results($que);
    
        

        if($result > 0){


            $output.= '<h4> Survey List </h4><ul>'; 
            foreach($result as $a){
         
               $url =  $current_url."/?sid=".$a->surveyid;
               $output.= '<a href="'.$url.'" data-sid="'.$a->surveyid.'" class="survey_data"><li>'.$a->name .'</li></a>';
             // $output.= ' <li class="survey_data" data-sid="'.$a->surveyid.'">'.$a->name .'</li>';
            }
            
              
               $output.= '</ul>';  
               
        }
}

else{
    $output.= '<h4> No survey </h4>';
} 








