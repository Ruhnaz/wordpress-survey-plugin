<?php

      $id=$_GET['id'];
      global $wpdb,$table_prefix;     
    
        $table_q = $wpdb->prefix . 'smp_question'; 
   
        $wpdb->delete( $table_q, array( 'id' => $id ) ); 
        
    
        $table_option = $wpdb->prefix . 'smp_survey_options'; 
       
          $wpdb->delete( $table_option, array( 'question_id' => $id ) );
       
         
        
    
     
    
    $url=site_url()."/wp-admin/admin.php?page=SMP_Question";
    echo("<script>location.href = '".$url."';</script>"); 

?>
