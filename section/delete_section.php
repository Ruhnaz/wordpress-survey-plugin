<?php
$msg="";



  
    
    
   
      $id=$_GET['id'];
      global $wpdb,$table_prefix;     
      $table_name = $wpdb->prefix . 'smp_section';  
        $wpdb->delete( $table_name, array( 'id' => $id ) );  
       
        
    
       
    
    $url=site_url()."/wp-admin/admin.php?page=SMP_Section";
    echo("<script>location.href = '".$url."';</script>"); 

?>
