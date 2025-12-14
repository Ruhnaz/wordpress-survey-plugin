<?php
   $msg="";


if(isset($_POST['but_submit'])){
   $name = $_POST['title'];
   $Des = $_POST['desc'];
   $section = $_POST['section'];
   $option = $_POST['option'];
   $seq = $_POST['seq'];
   $survey_id = $_POST['survey'];
   $status = $_POST['status'];
   $created_date = date('Y-m-d H:i:s');
   $updated_date = date('Y-m-d H:i:s');
   $created_by = get_current_user_id();
   $updated_by = get_current_user_id();
   $hidden = $_POST['hidden'];
   
global $wpdb;     
  $table_name = $wpdb->prefix . 'smp_question';     
  $wpdb->insert($table_name, array('status' => $status, 'name' => $name,'des' => $Des,'section_id' => $section,'optiontype' => $option,'sequence' => $seq,'survey_id' => $survey_id,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
  $table_second = $wpdb->prefix . 'smp_survey_options'; 
  $lastid = $wpdb->insert_id;
  for($i=1; $i<=$hidden; $i++){
  $wpdb->insert($table_second, array('status' => 'Active', 'name' => $_POST['option'.$i],'question_id' => $lastid,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
  }
  $msg= '<strong>Saved Sucessfully!</strong>';
	$url=site_url()."/wp-admin/admin.php?page=SMP_Question";
 echo("<script>location.href = '".$url."';</script>"); 
}
 
?>
<h1 align="center">SMP Question</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>

<h3 align="center" style="color: #00CC00"><?php echo $msg;?></h3>
<!-- Form -->
  <table class="widefat fixed" cellspacing="0" border="0">
    <tr>
      <th class="column-columnname" width="20%">ID</th>
      <td ><input type='text' name="id" disabled="disabled" value="0" class="input_text" /></td>
    </tr>
      <tr>
      <th > Name *</th>
      <td><input type="text" name="title" class="input_text" style="width:250px" required/></td>
    </tr>
    <tr>
       

       <th >Description*</th>
       <td><textarea name="desc" class="input_text" style="width:250px" required/></textarea>
     </tr>
     <tr>
      
      <th > Section*</th>
      <?php  global $table_prefix, $wpdb;
       $row_class="alternate";
          $tblname = 'smp_section';
          $wp_track_table = $table_prefix . "$tblname";
          $que="SELECT * FROM {$wp_track_table};";
          $i=0;
          $r = $wpdb->get_results($que);// print_r($result);
          ?>
          <td>
        <select style="width:250px" name="section" required>
        <?php  foreach($r as $row) :
          echo '<option value="' . $row->id . '">' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
    </tr>
    <tr>
      
      <th > Optiontype*</th>
      
          <td>
        <select style="width:250px" name="option"  id="option_select" required>
        <option value="">Option Type</option>
                
            
                 <option value="0">Text Box</option>
                 <option value="1">Text Area</option>
                 <option value="2">Dropdown</option>
                 <option value="3">Radio</option>
                 <option value="4">Checkbox</option>
                
      </select></td>
    </tr>
    
    <tr class="option_no">
      <th > How Many Options</th>
      <td>
      <input type="number" id="quantity" min="1" max="25" style="width:250px"  name="seq" >
     
    </td> 
   
     
   
    </tr>
    <tr class="option_values" style="margin-left:50px;">

</tr>

  
   
   
    
    <tr>
      <th > Question Sequence<br>(between 1 to 25)</th>
      <td>
      <input type="number" id="quantity" min="1" max="25" style="width:250px"  name="seq">
        
    </tr>
    <tr>
      
      <th > Select Survey*</th>
      <?php  global $table_prefix, $wpdb;
       $row_class="alternate";
          $tblname = 'smp_survey';
          $wp_track_table = $table_prefix . "$tblname";
          $que="SELECT * FROM {$wp_track_table};";
          $i=0;
          $r1= $wpdb->get_results($que);// print_r($result);
          ?>
          <td>
        <select style="width:250px" name="survey" required>
        <?php  foreach($r1 as $row) :
          echo '<option value="' . $row->surveyid . '">' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
    </tr>
    <tr>
      <th >Status</th>
      <td><select style="width:250px" name="status" required><option value="1">Active</option><option value="0">Inactive</option></select></td>
    </tr>
  
   
     
 
  </table>
  <h2 align="center"><input type="submit" value="Save" class="button" name="but_submit"/>&nbsp;&nbsp;<input type="button" value="Cancel" class="button" onclick="javascript: history.go(-1)"/></h2>
</form>
<script>
 
  jQuery(document).ready(function($){
    
    $(".option_no").hide();
    jQuery("#option_select").on("change", function(){
      var optionType = $(this).val();
      $(".option_values").html("");
      $("#quantity").val("");
    console.log(optionType);
    if (optionType != 0 && optionType !=1){
     
      $(".option_no").show();
     
    }
    else{
      
      $(".option_no").hide();
     
    }
       
    });
    $('#quantity').on('change', function(){
               var number = $(this).val();
              // var params = "http:\/\/example.com\/wp-admin\/admin-ajax.php";
              
                   // console.log(params);
                jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "get_options", number : number,},
                  success : function(res){
                     $(".option_values").html(res);
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
              });
});
  </script>