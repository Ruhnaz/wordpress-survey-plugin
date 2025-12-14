<?php
   $msg="";


if(isset($_POST['but_submit'])){
   $name = $_POST['title'];
   $status = $_POST['status'];
   $survey = $_POST['survey'];
   $start_date = $_POST['start_date'];
   $end_date = $_POST['end_date'];
   $created_date = date('Y-m-d H:i:s');
   $updated_date = date('Y-m-d H:i:s');
   $created_by = get_current_user_id();
   $updated_by = get_current_user_id();

global $wpdb;     
  $table_name = $wpdb->prefix . 'smp_survey_batch';     
  $wpdb->insert($table_name, array('status' => $status, 'name' => $name,'surveyid' => $survey,'start_date' => $start_date,'end_date' => $end_date,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
    $msg= '<strong>Saved Sucessfully!</strong>';
	$url=site_url()."/wp-admin/admin.php?page=SMP_Survey_batch";
 echo("<script>location.href = '".$url."';</script>"); 
}

?>
<h1 align="center">SMP Survey Batch</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>

<h3 align="center" style="color: #00CC00"><?php echo $msg;?></h3>
<!-- Form -->
  <table class="widefat fixed" cellspacing="0" border="0">
    <tr>
      <th class="column-columnname" width="20%">ID</th>
      <td ><input type='text' name="id" disabled="disabled" value="0" class="input_text" /></td>
    </tr>
      <tr>
      <th >Batch Name *</th>
      <td><input type='text' name="title" class="input_text"  required/></td>
    </tr>
 
    <tr>
      <th >Select Survey *</th>
      
      <td>
      <?php  
      
       global $wpdb,$table_prefix;
      
      $tblname = 'smp_survey';
          $wp_track_table = $table_prefix . "$tblname";
          $que="SELECT * FROM {$wp_track_table}";
         
          $result = $wpdb->get_results($que);
          ?>
          
        <select style="width:250px" name="survey" required>
        <?php  foreach($result as $row) :
          echo '<option value="' . $row->surveyid . '">' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
    </tr>
    <tr>
      <th >Start Date *</th>
      <td><input type='date' style="width:180px" name="start_date" class="select_date"  required/></td>
    </tr>
    <tr>
      <th >End Date *</th>
      <td><input type='date' style="width:180px"  name="end_date" class="input_text"  required/></td>
    </tr>

    <tr>
      <th >Status</th>
      <td><select style="width:250px" name="status" required><option value="1">Active</option><option value="0">Inactive</option></select></td>
    </tr>
  
   
     
 
  </table>
  <h2 align="center"><input type="submit" value="Save" class="button" name="but_submit"/>&nbsp;&nbsp;<input type="button" value="Cancel" class="button" onclick="javascript: history.go(-1)"/></h2>
</form>