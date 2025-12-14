<?php
   $msg="";


if(isset($_POST['but_submit'])){
   $name = $_POST['title'];
   $shortcode = $_POST['shortcode'];
  
   $status = $_POST['status'];
   $created_date = date('Y-m-d H:i:s');
   $updated_date = date('Y-m-d H:i:s');
   $created_by = get_current_user_id();
   $updated_by = get_current_user_id();
  
   
global $wpdb;     
  $table_name = $wpdb->prefix . 'smp_survey_languages';     
  $wpdb->insert($table_name, array('status' => $status, 'name' => $name,'shortcode' => $shortcode,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
 
  $msg= '<strong>Saved Sucessfully!</strong>';
	$url=site_url()."/wp-admin/admin.php?page=SMP_Language";
 echo("<script>location.href = '".$url."';</script>"); 
}

?>
<h1 align="center">SMP Language</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>

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
      <th > Shortcode*</th>
      <td><input type="text" name="shortcode" class="input_text" style="width:250px" required/></td>
    </tr>
   
    <tr>
      <th >Status</th>
      <td><select style="width:250px" name="status" required><option value="1">Active</option><option value="0">Inactive</option></select></td>
    </tr>
  
   
     
 
  </table>
  <h2 align="center"><input type="submit" value="Save" class="button" name="but_submit"/>&nbsp;&nbsp;<input type="button" value="Cancel" class="button" onclick="javascript: history.go(-1)"/></h2>
</form>
