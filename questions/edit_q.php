<?php
$msg="";
if(isset($_POST['but_submit'])){
	
		$id = $_POST['id'];
	
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
    if(isset($_POST['hidden'])){
      $hidden = $_POST['hidden'];
    }
    if(isset($_POST['hiddenoption'])){
    $hiddenoption = $_POST['hiddenoption'];
    }
    global $wpdb,$table_prefix;     
  
    $table_name = $wpdb->prefix . 'smp_question';     
    $wpdb->update($table_name, array('status' => $status, 'name' => $name,'des' => $Des,'section_id' => $section,'optiontype' => $option,'sequence' => $seq,'survey_id' => $survey_id,'updated_date' =>$updated_date,'updated_by' =>$updated_by),array('id' => $id)); 
    $lastid = $wpdb->insert_id;
    $tblname = 'smp_survey_options';
 $wp_track_table = $table_prefix . "$tblname";
 $que="SELECT * FROM {$wp_track_table} where question_id = $id ";

 $result = $wpdb->get_results($que);// print_r($result);
 if(isset($hidden)){
  if(count($result) > 0){
    $wpdb->delete($wp_track_table, array( 'question_id' => $id ) );
   
 }
 for($i=1; $i<=$hidden; $i++){
  $name =  $_POST['option'.$i];
 
 
  $wpdb->insert($wp_track_table, array('status' => 'Active', 'name' => $name,'question_id' => $id,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
 }
}
if(isset($hiddenoption)){
  if(count($result) > 0){
   
    for($i=1; $i<=$hiddenoption; $i++){
     $val =  $_POST['o'.$i];
    
    
      $wpdb->update($wp_track_table, array('status' => 'Active', 'name' => $val,'question_id' => $id,'updated_date' =>$updated_date,'updated_by' =>$updated_by),array('id' => $result[$i-1]->id)); 
     }
 }
 
}
 $msg= '<strong>Updated Sucessfully!</strong>';
$url=site_url()."/wp-admin/admin.php?page=SMP_Question";
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
      $tblname = 'smp_question';
      $wp_track = $table_prefix . "$tblname";
      $que="SELECT * FROM {$wp_track} WHERE id =$id";

      $result = $wpdb->get_results($que); 
     
      $tbl = 'smp_survey_options';
      $wp_table = $table_prefix . "$tbl";
      $query="SELECT * FROM {$wp_table} WHERE question_id =$id";

      $res = $wpdb->get_results($query); 

      
?>
<h1 align="center">SMP Question : Edit </h1><form method='post' action='' name='myform' enctype='multipart/form-data'>
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
      <th > Name *</th>
      <td><input type="text" name="title" class="input_text" style="width:250px" value="<?php echo $result[0]->name;?>" required/></td>
    </tr>
    <th >Description*</th>
       <td><textarea name="desc" class="input_text" style="width:250px" required/><?php echo $result[0]->des;?></textarea>
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
         if($row->id == $result[0]->section_id){
          $selected = "selected";}
          else{
            $selected = "";
          }
          echo '<option value="' . $row->id . '" '.$selected.'>' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
    </tr>
    <tr>
      
      <th > Optiontype*</th>
      
          <td>
        <select style="width:250px" name="option"  id="option_select" required>
        <option value="">Option Type</option>
                
            
                 <option value="0"<?php echo $result[0]->optiontype== 0 ? "selected" : ""?>>Text Box</option>
                 <option value="1"<?php echo $result[0]->optiontype== 1 ? "selected" : ""?>>Text Area</option>
                 <option value="2" <?php echo $result[0]->optiontype== 2 ? "selected" : ""?>>Dropdown</option>
                 <option value="3" <?php echo $result[0]->optiontype== 3 ? "selected" : ""?>>Radio</option>
                 <option value="4" <?php echo $result[0]->optiontype== 4 ? "selected" : ""?>>Checkbox</option>
                
      </select></td>
    </tr>
    
    <tr class="option_no">
      <th > How Many Options</th>
      <td>
      <input type="number" id="quantity" min="1" max="25" style="width:250px"  name="seq" >
     
    </td> 
   
   
   
    </tr>
   <?php if (isset($res)){
    $no= count($res);   $k = 1;
foreach($res as $res){ ?>

<tr class="edit_option">
        <th > Option No<?php echo $k; ?></th>
        <td><input type="text" name="o<?php echo $k; ?>" class="input_text"  value="<?php echo $res->name;?>" style="width:250px" required/></td>
     
   <?php $k++;  }  ?>
    
    <input type="hidden" name="hiddenoption" value="<?php echo $k-1;?>">
             
</tr>
<?php } ?>  
  
<tr class="option_values" style="margin-left:50px;">

</tr> 
   
    
    <tr>
      <th > Question Sequence<br>(between 1 to 25)</th>
      <td>
      <input type="number" id="quantity" min="1" max="25" style="width:250px"  value="<?php echo $result[0]->sequence; ?>" name="seq">
        
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
        
        <?php $selected = ""; foreach($r1 as $row) :
        if($row->surveyid == $result[0]->survey_id){
          $selected = "selected";
        }
          echo '<option value="' . $row->surveyid . '" '.$selected.'>' . $row->name . '</option>';
        
      endforeach;
        ?>
      </select></td>
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

<script>
 
 jQuery(document).ready(function($){
   
   $(".option_no").hide();
   jQuery("#option_select").on("change", function(){
    alert("Wants to change Options?");
    $(".edit_option").hide();
     var optionType = $(this).val();
   console.log(optionType);
   $(".option_values").html("");
      $("#quantity").val("");
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
 