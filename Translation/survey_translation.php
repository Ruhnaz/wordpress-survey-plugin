






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
<h1 align="center">SMP Survey :  Translation</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>

<h3 align="center" style="color: #00CC00" class="success-msg"><?php echo $msg;?></h3>
<!-- Form -->
  <table class="widefat fixed" cellspacing="0" border="0">
  <tr>
      <th align="right" width="20%">Type *</th>
      <td><select style="min-width:250px" name="type" class="type" required>
      <option value="2">Select Type</option>
      <option value="0">Questions</option>
      <option value="1">Options</option>
    </select></td>
    </tr>
   
     
    <tr>
      <th > Survey Question *</th>
      
      <td>
      
        <select style="min-width:250px" name="survey_question" class="survey-question" required>
      
      </select></td>
    </tr>
  
    
    <tr class="options_field">
      <th > Survey Options *</th>
      
      <td>
      
        <select style="min-width:250px" name="survey_option" class="survey-option" required>
      
      </select></td>
    </tr>
    <?php
    global $wpdb,$table_prefix;
   
     $tblname = 'smp_survey_languages';
         $wp_track_table = $table_prefix . "$tblname";
         $que="SELECT * FROM {$wp_track_table}";
        
         $result = $wpdb->get_results($que);
         $output = '';
       $i = 1;

         foreach($result as $row) {
            
         
             $output.= '<tr><th >'.$row->name.'</th>
             <td><input type="text" name="lang[]"  style="min-width:250px" id="'.$row->id.'" class="lang"/>
             <input type="hidden" name="langid[]"  value="'.$row->id.'" style="min-width:250px" class="input_text"/>
             </td>

             </tr>';
             $i++;
         }
         
 
       
     echo $output; 

     
       

     ?>
    
   
     
 
  </table>
  <h2 align="center"><input type="submit" value="Save" class="button" id="save" name="but_submit"/>&nbsp;&nbsp;<input type="button" value="Cancel" class="button" onclick="javascript: history.go(-1)"/></h2>
</form>
<script>
 
  jQuery(document).ready(function($){
   var type =  $(".type").val();
   if(type == 2 || type == 0){
    $(".options_field").hide();
   }
     
  
    $('.type').on('change', function(){
               var number = $(this).val();
             if(number == 0){
              $(".options_field").hide();
              $("input[name='lang[]']").each(function(index){
                      //console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
              jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "select_question"},
                  success : function(res){
                     $(".survey-question").html(res);
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
              
             }
             if(number == 1){
              $(".options_field").show();
              $("input[name='lang[]']").each(function(index){
                      //console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
              jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "select_question"},
                  success : function(res){
                     $(".survey-question").html(res);
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
                  var option_id = $('.survey-option').val();
                  var qid =  $('.survey-question').val();
                  //console.log(option_id);
                  console.log(type);
                  jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  dataType: 'json',
                  data: {action: "select_value",qid : qid,number:number,option_id:option_id},
                  success : function(res){
                    // $(".survey-question").html(res);
                 
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
             
               
             }
             if(number == 3){
              $(".options_field").hide();
              $("input[name='lang[]']").each(function(index){
                      //console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
             }    
              });

              $('.sel-op').on('change', function(){
               var number = $(this).val();
           
              jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "append_boxes"},
                  success : function(res){
                     $(".input_box").html(res);
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
              });
              $('.survey-question').on('change', function(){
             var qid=  $(this).val();
             $("input[name='lang[]']").each(function(index){
                      //console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
              jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "select_option",qid : qid},
                  success : function(res){
                     $(".survey-option").html(res);
                      console.log(res);
                      
                    },
                    error : function(){
                    console.log("error");
                }
                });
                var number =  $(".type").val();
                if(number == 0){
                  $("input[name='lang[]']").each(function(index){
                     // console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
                  jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  dataType: 'json',
                  data: {action: "select_value",qid : qid,number:number},
                  success : function(res){
                    // $(".survey-question").html(res);
                   $( res).each(function(index,value) {
                    index += 1;
                    $("input[name='lang[]']").each(function(index){
                      console.log(index);
                      index = index+1;
                      if(index==value.languageid){
                        $( "#"+index ).val( value.question_translation );
                      }
                    });
 
});
                      //console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });
                }
                
              });
              $('#save').on('click', function(e){ 
                e.preventDefault(); 
                var val =  $(".type").val();
                var q_id =  $('.survey-question').val();
              var option_id =  $('.survey-option').val();
                 
                 var values = $("input[name='lang[]']")
              .map(function(){
              
                  return $(this).val();
               
               
              }).get();
               var keys = $("input[name='langid[]']")
              .map(function(){
             
                  return $(this).val();
               
               
              }).get();
            
             var result =  values.reduce(function(result, field, index) {
  result[keys[index]] = field;
  return result;
}, {})
 

                if(val == 1){
                  console.log(keys);
                  console.log(keys);
                  console.log(result);
                  jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "option_translation",q_id : q_id,option_id:option_id,result:result},
                  success : function(res){
                    
    $(".success-msg").html(res);
                      console.log(res);
                      setTimeout(function() {
        $(".success-msg").html("");
    }, 3000);  
    
  },
                    error : function(){
                    console.log("error");
                }
                });
                }
                if(val == 0){
                  console.log(keys);
                  console.log(keys);
                  console.log(result);
                  jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  data: {action: "question_translation",q_id : q_id,result:result},
                  success : function(res){
                    
                    $(".success-msg").html(res);
                      console.log(res);
                      setTimeout(function() {
        $(".success-msg").html("");
    }, 3000);  
                    },
                    error : function(){
                    console.log("error");
                }
                });
                }
                
              }); 
              
                $('.survey-option').on('change', function(){
                 
                  $("input[name='lang[]']").each(function(index){
                      //console.log(index);
                     
                        $( "input[name='lang[]']").val("");
                   
                    });
                   select_lang();
              });
              function select_lang(){
                var option_id = $('.survey-option').val();
                  var qid =  $('.survey-question').val();
                  //console.log(option_id);
                  var number =  $(".type").val();
                  console.log(number);
                  console.log(option_id);
                  jQuery.ajax({
                 //url: ajax_object.ajax_url,
                 url: ajaxurl,
                  type: "post",
                  dataType: 'json',
                  data: {action: "select_value",qid : qid,number:number,option_id:option_id},
                  success : function(res){
                    // $(".survey-question").html(res);
                    var index = 1;
                    $( res).each(function(index,value) {
                     
                    $("input[name='lang[]']").each(function(index){
                      console.log(index);
                      index = index+1;
                      if(index==value.languageid){
                        $( "#"+index ).val( value.options_translation );
                        
                      }
                      //index += 1;
                    });
 
});
                      console.log(res);
                    },
                    error : function(){
                    console.log("error");
                }
                });        
              }
                      
                  
});

  </script>    