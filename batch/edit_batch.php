<?php
$msg="";
if(isset($_POST['but_submit'])){
		$name = $_POST['title'];
		$status = $_POST['status'];
		$id = $_POST['id'];
    $survey = $_POST['survey'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
		$updated_date = date('Y-m-d H:i:s');
		$updated_by = get_current_user_id();
		
global $wpdb;     
  $table_name = $wpdb->prefix . 'smp_survey_batch';     
 $wpdb->update($table_name, array('status' => $status, 'name' => $name,'surveyid' => $survey,'start_date' => $start_date,'end_date' => $end_date,'updated_date' =>$updated_date,'updated_by' =>$updated_by),array('batchid' => $id)); 
    $msg= '<strong>Updated Sucessfully!</strong>';
$url=site_url()."/wp-admin/admin.php?page=SMP_Survey_batch";
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
      $tblname = 'smp_survey_batch';
      $wp_track_table = $table_prefix . "$tblname";
      $que="SELECT * FROM {$wp_track_table} WHERE batchid =$id";

      $result = $wpdb->get_results($que); 
?>
<h1 align="center">SMP Batch : Edit </h1><form method='post' action='' name='myform' enctype='multipart/form-data'>
<h3 align="center" style="color: #00CC00"><?php echo $msg;?></h3>
<!-- Form -->
  <table class="widefat fixed" cellspacing="0" border="0">
    <tr>
      <th align="right" width="20%">ID</th>
      <td><input type='text' name="id" disabled="disabled" value="<?php echo $result[0]->batchid?>" class="input_text" />
      <input type='hidden' name="id" value="<?php echo $result[0]->batchid?>" />
      </td>
    </tr>
    
    <tr>
      <th >Batch Name *</th>
      <td><input type='text' name="title" class="input_text" value="<?php echo $result[0]->name;?>" required/></td>
    </tr>
 
    <tr>
      <th >Select Survey *</th>
      
      <td>
      <?php  
      
       global $wpdb,$table_prefix;
      
      $tblname = 'smp_survey';
          $wp_track_table = $table_prefix . "$tblname";
          $que="SELECT * FROM {$wp_track_table}";
         
          $r= $wpdb->get_results($que);
          
          
          ?>
          
        <select style="width:250px" name="survey" required>
        <?php  foreach($r as $row) :
        if($row->surveyid == $result[0]->surveyid){
          $selected = "selected";}
          else{
            $selected = "";
          }
          echo '<option value="' . $row->surveyid . '"' .$selected.'>' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
    </tr>
    <tr>
      <th >Start Date *</th>
      <td><input type='date' style="width:250px" name="start_date" class="select_date" value="<?php echo $result[0]->start_date;?>" required/></td>
    </tr>
    <tr>
      <th >End Date *</th>
      <td><input type='date' style="width:250px"  name="end_date" value="<?php echo $result[0]->end_date;?>" class="input_text"  required/></td>
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

  
 