<?php

      $id=$_GET['id'];
      global $wpdb,$table_prefix;     
    
        $table_b = $wpdb->prefix . 'smp_survey_batch'; 
        $wpdb->delete( $table_b, array( 'batchid' => $id ) ); 
        
    
       
    $url=site_url()."/wp-admin/admin.php?page=SMP_Survey_batch";
    echo("<script>location.href = '".$url."';</script>"); 

?>
