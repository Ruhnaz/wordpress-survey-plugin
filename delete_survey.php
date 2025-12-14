<?php
$msg="";



  
    
    
   
      $id=$_GET['id'];
      global $wpdb,$table_prefix;     
      $table_name = $wpdb->prefix . 'smp_survey';  
        $wpdb->delete( $table_name, array( 'surveyid' => $id ) );  
        $table_b = $wpdb->prefix . 'smp_survey_batch'; 
        $wpdb->delete( $table_b, array( 'surveyid' => $id ) ); 
        
    
        $table_q = $wpdb->prefix . 'smp_question'; 
       
        $que="SELECT * FROM {$table_q} WHERE survey_id =$id";
        $result = $wpdb->get_results($que);
        $table_option = $wpdb->prefix . 'smp_survey_options'; 
        foreach($result as $r){
          $wpdb->delete( $table_option, array( 'question_id' => $r->id ) );
        }
         
        $wpdb->delete( $table_q, array( 'survey_id' => $id ) ); 
        
    
       
        
    
     
    
    $url=site_url()."/wp-admin/admin.php?page=SMP_Survey";
    echo("<script>location.href = '".$url."';</script>"); 

?>
