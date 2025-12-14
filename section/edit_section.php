<?php
$msg="";
if(isset($_POST['but_submit'])){
		$name = $_POST['title'];
    $Desc = $_POST['desc'];
		$status = $_POST['status'];
		$id = $_POST['id'];
		$updated_date = date('Y-m-d H:i:s');
		$updated_by = get_current_user_id();
		
global $wpdb;     
  $table_name = $wpdb->prefix . 'smp_section';     
 $wpdb->update($table_name, array('status' => $status, 'name' => $name,'des' => $Desc,'updated_date' =>$updated_date,'updated_by' =>$updated_by),array('id' => $id)); 
    $msg= '<strong>Updated Sucessfully!</strong>';
$url=site_url()."/wp-admin/admin.php?page=SMP_Section";
 echo("<script>location.href = '".$url."';</script>"); 
 
}

?><style>
.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
}

.input_text {

  width: 250px;
  
}

</style>
<?php 
       $id=$_GET['id'];

     global $table_prefix, $wpdb;
      $tblname = 'smp_section';
      $wp_track_table = $table_prefix . "$tblname";
      $que="SELECT * FROM {$wp_track_table} WHERE id =$id";

      $result = $wpdb->get_results($que); 
?>
<h1 align="center">SMP Survey : Edit </h1><form method='post' action='' name='myform' enctype='multipart/form-data'>
<h3 align="center" style="color: #00CC00"><?php echo $msg;?></h3>
<!-- Form -->
  <table class="widefat fixed" cellspacing="0" border="0">
    <tr>
      <th align="right" width="20%">ID</th>
      <td><input type='text' name="id" disabled="disabled" value="<?php echo $result[0]->id?>" class="input_text" />
      <input type='hidden' name="id" value="<?php echo $result[0]->id?>" />
      </td>
    </tr>
     <tr>
      <td>Section Name *</td>
      <td><input type='text' name="title" class="input_text" value="<?php echo $result[0]->name;?>"  required/></td>
    </tr>
    <tr>
       

       <th >Description*</th>
       <td><textarea name="desc" class="input_text"  required/><?php echo $result[0]->des;?></textarea>
     </tr>
    <tr>
      <th align="right">Status</th>
      <td>
      <?php  $sel1="";$sel2="";
	  		$value=$result[0]->status;
	        if($value==1)
			$sel1="selected";
			if($value==0)
			$sel2="selected";
			
			
	  ?>
      <select style="width:250px" name="status"><option value="1" <?php echo $sel1?>>Active</option><option value="0" <?php echo $sel2?>>Inactive</option></select></td>
    </tr>
    
     
  
     
    
  </table>
   <h2 align="center"><input type="submit" value="Save" class="button" name="but_submit"/>&nbsp;&nbsp;<input type="button" value="Cancel" class="button" onclick="javascript: history.go(-1)"/></h2>

</form>

  
 