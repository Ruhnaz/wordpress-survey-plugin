





<h1 align="center">SMP Survey :  User Meta Data</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>

<h3 align="center" style="color: #00CC00" class="success-msg"><?php ?></h3>
<!-- Form -->
 

<table class="widefat fixed" cellspacing="0" border="0">
      <thead>
        <tr>
       
         <th id="cb" class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Username</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Email</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Batch Name</th>
            
          <th id="columnname" class="manage-column column-columnname" scope="col">ID</th>
        </tr>
        </thead>
          <tfoot>
        <tr>
        <th id="cb" class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Username</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Email</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Batch Name</th>
            
          <th id="columnname" class="manage-column column-columnname" scope="col">ID</th>
               
    
        </tr>
        </tfoot>
        <tbody>
    
          <?php
   $msg="";
$users = get_users(
   //array( 'fields' => array( 'ID' ) )
    array('role'    => 'subscriber',
        'orderby' => 'ID',
        'order'   => 'ASC'
    )
 );
 $i=0;
foreach($users as $user){
   
   $meta_data = get_user_meta ( $user->ID);
    /*echo "<pre>";
       print_r(get_user_meta ( $user->ID));
 echo "</pre>";*/
 $i++;
          if($i%2==0)
          $row_class="";
          else
          $row_class="alternate";
        
?>  
        
        <tr class="<?php echo $row_class;?>" id="row_<?php echo $i; ?>">
        <td class="column-columnname"><input type="checkbox" /></td><td class="column-columnname"><a href="#" style="text-decoration:none"><?php echo $user->display_name; ?></a> <div class="row-actions">
                       
                     <!--   <span><a href="#">View</a></span>-->
                    </div></td>
              <td class="column-columnname"><?php echo $user->user_email; ?></td>
             
        
        <td class="column-columnname"><?php
         if(isset($meta_data['_batchid'][0])){ 
       // echo $meta_data['_batchid'][0]; 
    }
        global $table_prefix, $wpdb;
        $row_class="alternate";
           $tblname = 'smp_survey_batch';
           $wp_track_table = $table_prefix . "$tblname";
           $que="SELECT * FROM {$wp_track_table};";
           $i=0;
           $r1= $wpdb->get_results($que);// print_r($result);
        ?>
          <select name="batch"  class="batch_change" data-uid="<?php echo $user->id;?>" required>
        <option value="">Change Batch to...</option>
          <?php  foreach($r1 as $row) :
           if($row->batchid == $meta_data['_batchid'][0]){
            $selected = "selected";}
            else{
              $selected = "";
            }
          echo '<option value="' . $row->batchid . '" '.$selected.'>' . $row->name . '</option>';
       
      endforeach;
        ?>
       
        </td>
     <td class="column-columnname"><?php echo $user->id; ?></td>

        </tr>
        <?php } ?>
      
        
         </tbody>
       
       </table> 
    </form>
    <?php
$userid = wp_get_current_user();
        $user_batch_id = get_user_meta( $userid->ID, '_batchid' );
      
      
        ?>

    <script>
 
 jQuery(document).ready(function($){
   
   
   $('.batch_change').on('change', function(){
   
              var batchid = $(this).val();
             // var params = "http:\/\/example.com\/wp-admin\/admin-ajax.php";
            // var id = $(".hidden_user_id").val();
            var userid = $(this).data('uid');
                  console.log(userid);
               jQuery.ajax({
                //url: ajax_object.ajax_url,
                url: ajaxurl,
                 type: "post",
                 data: {action: "update_batch_meta", batchid : batchid,userid:userid},
                 success : function(res){
                   // $(".option_values").html(res);
                     console.log(res);
                   },
                   error : function(){
                   console.log("error");
               }
               });
             });
});
 </script>
 