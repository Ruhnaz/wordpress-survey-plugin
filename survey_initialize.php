<?php
/**
* Plugin Name: wp-plugin-smp-survey
* Plugin URI: 
* Description: Easily create  Surveys , Questions with wp-plugin-smp-survey Plugin.
* Version: 0.1
* Author: your-name
* Author URI:
**/
if(!defined('ABSPATH')){
    die("can't access");
}
add_action("admin_menu", "SMP_Survey_plugin_menu");
function SMP_Survey_plugin_menu() 
{

 add_menu_page("SMP Survey : Survey", "SMP Survey","manage_options", "SMP_Survey", "SMP_Survey_first","dashicons-format-aside");

 
 
 add_submenu_page("SMP_Survey", "batches","batches","manage_options","SMP_Survey_batch", "SMP_Survey_batches_function");
 add_submenu_page("SMP_Survey", "questions","questions","manage_options","SMP_Question", "SMP_Survey_Question_function");
 add_submenu_page("SMP_Survey", "section","section","manage_options","SMP_Section", "SMP_Section_function");
 add_submenu_page("SMP_Survey", "Language","Language","manage_options","SMP_Language", "SMP_Language_function");
add_submenu_page("SMP_Survey", "Survey-Translation","Survey_Translation","manage_options","SMP_Survey_Translation", "SMP_Survey_Translation");
add_submenu_page("SMP_Survey", "User_Meta","User_Meta","manage_options","SMP_User_Meta", "SMP_User_Meta_function");
}



function SMP_Survey_first(){
    include "render_survey_pages.php"; 
    }
    function SMP_Survey_batches_function(){
        include "batch/survey_batches_pages.php"; 
        }
        function SMP_Survey_Question_function(){
            include "questions/survey_questions_pages.php"; 
            }
function SMP_Section_function(){
    include "section/survey_sections_pages.php"; 
        }
        function SMP_Option_function(){
            include "options/survey_options_pages.php"; 
                }
                function SMP_Language_function(){
                    include "languages/survey_languages_pages.php"; 
   
                }
     function SMP_Survey_Translation(){
            include "Translation/survey_translation.php"; 
            }
            function SMP_User_Meta_function(){
                include "Users/Change_Meta.php"; 
                }
    function create_SMP_Survey_database_table()
{
 global $table_prefix, $wpdb;

 
$tblname = 'smp_survey';
 $wp_track_table = $table_prefix . "$tblname";

if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
 {

             $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
           $sql .= "surveyid int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
            $sql .= "name VARCHAR(255) NOT NULL,";
            $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
             $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
             $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
             $sql .= "created_by INT(11) NOT NULL,";
             $sql .= "updated_by INT(11) NOT NULL,";    

         $sql .= "PRIMARY KEY (surveyid)";
         $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

     dbDelta($sql);
    }
    $tblname = 'smp_survey_batch';
    $wp_track_table = $table_prefix . "$tblname";

    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
     {

 $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
 $sql .= "batchid int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
 $sql .= "surveyid int(11) NOT NULL,";
 $sql .= "name VARCHAR(255) NOT NULL,";
 $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
 $sql .= "start_date DATE NOT NULL ,";
 $sql .= "end_date DATE NOT NULL ,";
 $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
 $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
 $sql .= "created_by INT(11) NOT NULL,";
 $sql .= "updated_by INT(11) NOT NULL,";

 $sql .= "PRIMARY KEY (batchid)";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
    $tblname = 'smp_section';
    $wp_track_table = $table_prefix . "$tblname";
   
   if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
    {
   
                $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
              $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
               $sql .= "name VARCHAR(255) NOT NULL,";
               $sql .= "des VARCHAR(255) NOT NULL,";
               $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                $sql .= "created_by INT(11) NOT NULL,";
                $sql .= "updated_by INT(11) NOT NULL,";    
   
            $sql .= "PRIMARY KEY (id)";
            $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
           require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
   
        dbDelta($sql);
       }
       $tblname = 'smp_question';
       $wp_track_table = $table_prefix . "$tblname";
      
      if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
       {
      
                   $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                 $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                  $sql .= "name VARCHAR(255) NOT NULL,";
                  $sql .= "des VARCHAR(255) NOT NULL,";
                  $sql .= "section_id INT(11) NOT NULL,";
                  $sql .= "optiontype INT(11) NOT NULL,";
                  $sql .= "sequence INT(11) NOT NULL,";
                  $sql .= "survey_id INT(11) NOT NULL,";
                  $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                   $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                   $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                   $sql .= "created_by INT(11) NOT NULL,";
                   $sql .= "updated_by INT(11) NOT NULL,";    
      
               $sql .= "PRIMARY KEY (id)";
               $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
              require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
      
           dbDelta($sql);
          }
          $tblname = 'smp_survey_options';
          $wp_track_table = $table_prefix . "$tblname";
         
         if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
          {
         
                      $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                    $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                     $sql .= "name VARCHAR(255) NOT NULL,";
                    
                     $sql .= "question_id INT(11) NOT NULL,";
                     $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                      $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                      $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                      $sql .= "created_by INT(11) NOT NULL,";
                      $sql .= "updated_by INT(11) NOT NULL,";    
         
                  $sql .= "PRIMARY KEY (id)";
                  $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
                 require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
         
              dbDelta($sql);
             }   
         
             $tblname = 'smp_survey_languages';
             $wp_track_table = $table_prefix . "$tblname";
            
            if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
             {
            
                         $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                       $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                        $sql .= "name VARCHAR(255) NOT NULL,";
                        $sql .= "shortcode VARCHAR(255) NOT NULL,";
                       
                        $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                         $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                         $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                         $sql .= "created_by INT(11) NOT NULL,";
                         $sql .= "updated_by INT(11) NOT NULL,";    
            
                     $sql .= "PRIMARY KEY (id)";
                     $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
                    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            
                 dbDelta($sql);
                }
                $tblname = 'smp_answers';
                $wp_track_table = $table_prefix . "$tblname";
               
               if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
                {
               
                            $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                          $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                           
                           $sql .= "question_id int(11) NOT NULL,";
                           $sql .= "options varchar(255) NOT NULL,";
                           $sql .= "user_id int(11) NOT NULL,";
                           $sql .= "batch_id int(11) NOT NULL,";
                         
                           $sql .= "answer_from varchar(255) NOT NULL DEFAULT 'web',";
                          
                            $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                            $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                            $sql .= "created_by INT(11) NOT NULL,";
                            $sql .= "updated_by INT(11) NOT NULL,";    
               
                        $sql .= "PRIMARY KEY (id)";
                        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8";
                       require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
               
                    dbDelta($sql);
                   }
                   $tblname = 'smp_questions_translations';
                   $wp_track_table = $table_prefix . "$tblname";
                  
                  if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
                   {
                  
                               $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                               $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                             $sql .= "questionid int(11) NOT NULL ,";
                             $sql .= "languageid int(11)  NOT NULL,";
                             $sql .= "question_translation varchar(255) NOT NULL ,";
                              $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                               $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                               $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                               $sql .= "created_by INT(11) NOT NULL,";
                               $sql .= "updated_by INT(11) NOT NULL,";    
                  
                           $sql .= "PRIMARY KEY (id)";
                           $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
                          require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
                  
                       dbDelta($sql);
                      }
                      $tblname = 'smp_options_translations';
                      $wp_track_table = $table_prefix . "$tblname";
                     
                     if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
                      {
                     
                                  $sql = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ." ( ";
                                  $sql .= "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
                                  $sql .= "option_id int(11) NOT NULL,";
                                $sql .= "questionid int(11)  NOT NULL ,";
                                $sql .= "languageid int(11)  NOT NULL,";
                                $sql .= "options_translation varchar(255) NOT NULL ,";
                                 $sql .= "status TINYINT(1) NOT NULL DEFAULT '1',";
                                  $sql .= "created_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                                  $sql .= "updated_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
                                  $sql .= "created_by INT(11) NOT NULL,";
                                  $sql .= "updated_by INT(11) NOT NULL,";    
                     
                              $sql .= "PRIMARY KEY (id)";
                              $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
                             require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
                     
                          dbDelta($sql);
                         }
                         
                    
}

register_activation_hook( __FILE__, 'create_SMP_Survey_database_table' );



add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue() {
           
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/my_query.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
/*add_action('wp_ajax_next_btn', 'next_btn');
function get_options(){
    echo "hii ajax";
}*/
function enqueue_custom_plugin_styles() {
    // Get the URL of your custom stylesheet in the plugin directory
    $css_file_url = plugins_url('custom-plugin-style.css', __FILE__);
    $js_file_url = plugins_url('plugin-custom-script.js', __FILE__);


    // Enqueue the custom stylesheet
    wp_enqueue_style('custom-plugin-style', $css_file_url, array(), rand(111,9999), 'all');
    wp_enqueue_script('custom-plugin-script',$js_file_url, array('jquery'), 3.7,true);
   
}

// Hook the enqueue function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'enqueue_custom_plugin_styles');

add_action('wp_ajax_get_options', 'prefix_ajax_get_options' );
function prefix_ajax_get_options(){
   
    $number = $_POST['number'];
    echo $number;
   /* $output = '';
    for($i=$number; $i>0; $i--){
        $n = $i-1;
        $output .= '<tr>
        <th > option'.$number-$n.'</th>
        <td><input type="text" name="option'.$number-$n.'" class="input_text" style="width:250px" required/></td>
      </tr>';
    }
      $output.='<input type="hidden" name="hidden" value="'.$number.'">';
     echo $output;*/

     ob_start();
     $output = '';
    for($i=$number; $i>0; $i--){
        $n = $i-1;
        ?>
<tr >
        <th >Option&nbspNo<?php echo $number-$n;?></th>
        <td><input type="text" name="option<?php echo $number-$n;?>"class="input_option_box" style="width:250px; margin-left:150px; " required/></td></tr>
    <?php } ?>
        <input type="hidden" name="hidden"  value="<?php echo $number;?>">
        <?php
        echo ob_get_clean();
    wp_die();
}

add_action('wp_ajax_select_question', 'prefix_ajax_select_question' );
function prefix_ajax_select_question(){
   
   
   
   /* $output = '';
    for($i=$number; $i>0; $i--){
        $n = $i-1;
        $output .= '<tr>
        <th > option'.$number-$n.'</th>
        <td><input type="text" name="option'.$number-$n.'" class="input_text" style="width:250px" required/></td>
      </tr>';
    }
      $output.='<input type="hidden" name="hidden" value="'.$number.'">';
     echo $output;*/
    
        global $wpdb,$table_prefix;
      
        $tblname = 'smp_question';
            $wp_track_table = $table_prefix . "$tblname";
            $que="SELECT * FROM {$wp_track_table}";
           
            $result = $wpdb->get_results($que);
            $output = '';
            
            $output.= '<option value="">->Select Question</option>';
            foreach($result as $row) {
                $output.= '<option value="' . $row->id . '">->' . $row->des . '</option>';
          
            }
            
    
          
        echo $output;
        }


        add_action('wp_ajax_select_option', 'prefix_ajax_select_option' );
        function prefix_ajax_select_option(){
            $number = $_POST['qid'];
        global $wpdb,$table_prefix;
      
        $tblname = 'smp_survey_options';
            $wp_track_table = $table_prefix . "$tblname";
            $que="SELECT * FROM {$wp_track_table} where question_id=$number ";
           
            $result = $wpdb->get_results($que);
            $output = '';
            $output.= '<option value="">->Select option</option>';
            foreach($result as $row) {
                $output.= '<option value="' . $row->id . '" class="sel-op">->' . $row->name . '</option>';
          
            }
            
    
          
        echo $output; 
     }

        
     add_action('wp_ajax_option_translation', 'prefix_ajax_option_translation' );
     function prefix_ajax_option_translation(){
         $q_id = $_POST['q_id'];
         $option_id = $_POST['option_id'];
         $r= $_POST['result'];
         $created_date = date('Y-m-d H:i:s');
         $updated_date = date('Y-m-d H:i:s');
         $created_by = get_current_user_id();
         $updated_by = get_current_user_id();
     global $wpdb,$table_prefix;
   
     $tblname = 'smp_options_translations';
         $wp_track_table = $table_prefix . "$tblname";
         foreach($r as $key=>$value){
            $result  = $wpdb->update($wp_track_table,array('optionid' => $option_id,'questionid' => $q_id,'languageid' => $key,'options_translation' => $value,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by),array('optionid' => $option_id,'languageid' => $key)); 
             
            if($value != ''){
                if ($result === FALSE || $result < 1) {
                $wpdb->insert($wp_track_table, array('optionid' => $option_id,'questionid' => $q_id,'languageid' => $key,'options_translation' => $value,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
            }
        } 
         }
       
         $msg = 'Successfully Added to Database';
         echo $msg;
         wp_die();
          //return $_POST['result'];
        }
  
        add_action('wp_ajax_question_translation', 'prefix_ajax_question_translation' );
        function prefix_ajax_question_translation(){
            $q_id = $_POST['q_id'];
           
            $r= $_POST['result'];
            $created_date = date('Y-m-d H:i:s');
            $updated_date = date('Y-m-d H:i:s');
            $created_by = get_current_user_id();
            $updated_by = get_current_user_id();
        global $wpdb,$table_prefix;
      
        $tblname = 'smp_questions_translations';
            $wp_track_table = $table_prefix . "$tblname";
            foreach($r as $key=>$value){
                $result  = $wpdb->update($wp_track_table,array('questionid' => $q_id,'languageid' => $key,'question_translation' => $value,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by),array('questionid' => $q_id,'languageid' => $key)); 
                if($value != ''){
                   
                    if ($result === FALSE || $result < 1) {
                        $wpdb->insert($wp_track_table, array('questionid' => $q_id,'languageid' => $key,'question_translation' => $value,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
                    }
                  
            }
        }
           
            $msg = 'Successfully Added to Database';
            echo $msg;
            wp_die();
             //return $_POST['result'];
          
        }
        add_action('wp_ajax_select_value', 'prefix_ajax_select_value' );
        function prefix_ajax_select_value(){
            $type = $_POST['number'];
            $qid = $_POST['qid'];
           
            if($type == 0){
                global $wpdb,$table_prefix;
      
                $tblname = 'smp_questions_translations';
                    $wp_track_table = $table_prefix . "$tblname";
                    
                   
                    $que="SELECT * FROM {$wp_track_table} where questionid=$qid ";
                   
                    $result = $wpdb->get_results($que);
                   
                    echo json_encode($result);
                
                    wp_die();
                     //return $_POST['result'];
            }
            if($type == 1){
                $option_id = $_POST['option_id'];
                global $wpdb,$table_prefix;
               
                $tblname = 'smp_options_translations';
                    $wp_track_table = $table_prefix . "$tblname";
                    
                  //  $que = $wpdb->get_results("select optionid,questionid,languageid,options_translation, from  $wp_track_table  where questionid=$qid");
                    $que="SELECT * FROM {$wp_track_table} where questionid=$qid AND optionid =$option_id;";
                   
                    $result = $wpdb->get_results($que);
                   //echo $result;
                    echo json_encode($result);
                
                    wp_die();
                     //return $_POST['result'];
            }
       
           
        }
   
        add_action('wp_ajax_update_batch_meta', 'prefix_ajax_update_batch_meta' );
        function prefix_ajax_update_batch_meta(){
            $batchid = $_POST['batchid'];
            $userid = $_POST['userid'];
            $previous_batch_meta = get_user_meta( $userid, '_batchid', false );
            if ( empty( $previous_batch_meta ) ) {
                add_user_meta( $userid, '_batchid',$batchid );
            }
            else{
                update_user_meta( $userid, '_batchid', $batchid);
            }
            
            $msg = 'Successfully Added to Database';
            echo $batchid;
            wp_die();
             //return $_POST['result'];
           }
           add_action('wp_ajax_load_survey_question', 'prefix_ajax_load_survey_question' );
           function prefix_ajax_load_survey_question(){
          
           // $output = $sid;
           include "question-form/question_p.php";  
          
                       echo $output;      
           wp_die();  
           } 
           add_action('wp_ajax_end_survey_question', 'prefix_ajax_end_survey_question' );
           function prefix_ajax_end_survey_question(){
          
           // $output = $sid;
           //include "question-form/question_p.php";  
           $output ='<div class="section-one" ><h4> </h4> <div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><div class="d-flex justify-content-between">Thats All the Questions we have,Thank you for yout time</div></div></div>';
                       echo $output;      
           wp_die();  
           } 
          // add_action('wp_ajax_next_btn', 'prefix_ajax_next_btn' );
          add_action('wp_ajax_next_btn', 'prefix_ajax_next_btn' );
function prefix_ajax_next_btn(){
           
           
               $q_id = $_POST['q_id'];
               $sid = $_POST['sid'];
               $type = $_POST['type'];
               $optionval = $_POST['optionval'];
            
           
                
            $datatype= var_dump($optionval);
               $count = $_POST['count'];
               $userid = wp_get_current_user();
               $user_batch_id = get_user_meta( $userid->ID, '_batchid', false );
               if(isset($user_batch_id[0])){ 
                $batch_id= $user_batch_id[0];
                //echo  $user_batch_id;
               }
              
               $created_date = date('Y-m-d H:i:s');
               $updated_date = date('Y-m-d H:i:s');
               $created_by = get_current_user_id();
               $updated_by = get_current_user_id();
              
                global $wpdb,$table_prefix;
      
                $tblname = 'smp_answers';
                    $wp_track_table = $table_prefix . "$tblname";
                    $que="SELECT * FROM {$wp_track_table} where question_id=$q_id AND user_id =$userid->ID;"; 
                    $data = $wpdb->get_results($que);
                   
                    
                        if(count($data) > 0){  
                                $wpdb->delete( $wp_track_table, array('question_id' => $q_id,'user_id' => $userid->ID ) );
                               
                            }
                      
                            if(is_array($optionval)){
                                for($i=0; $i<count($optionval); $i++){
                          $query=  $wpdb->insert($wp_track_table, array('question_id' => $q_id,'user_id' => $userid->ID,'options' => $optionval[$i],'batch_id' => $batch_id,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
                            
                        }
                    } 
                    if($type == "0" || $type == "1"){
$textdata = $optionval;
//DECLARE $textdata VARCHAR(255);
//SET  $textdata = $optionval;
                        $query= $wpdb->insert($wp_track_table, array('question_id' => $q_id,'options' => $textdata,'user_id' => $userid->ID,'batch_id' => $batch_id,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by));     
                    }
               else{
                $query= $wpdb->insert($wp_track_table, array('question_id' => $q_id,'options' => $optionval,'user_id' => $userid->ID,'batch_id' => $batch_id,'created_date' => $created_date,'updated_date' =>$updated_date,'created_by' =>$created_by,'updated_by' =>$updated_by)); 
               }
                              
                            
        echo $wpdb->last_query;
                          //echo json_encode($textdata);
                            wp_die();
               }
             
             // $msg = $qn
              
                //return $_POST['result'];
              
    
              
 
    add_action( 'user_register', 'my_add_user_meta');

function my_add_user_meta( $user_id ) {
   // Do checks if needed

  // die("yes.....");
    add_user_meta( $user_id, '_batchid', 8);
    
}
        
add_action('init', 'smp_shortcodes_init');
function smp_shortcodes_init(){add_shortcode( 'show_smp_survey', 'load_smp_survey' );
   
    function load_smp_survey(){
        $userid = wp_get_current_user();
            global $wpdb,$table_prefix, $wp;
            $output = '';
           // Question List Code
        if(isset($_GET['sid']))
        {
           
         
            ob_start(); // Start an output buffer
             
               
            
                ?>
               
               <?php $sid = $_GET['sid'];
             
             ?>
            <div class="survey-question" data-id="<?php echo $sid; ?>">
           <?php  ?>
                       </div>
       
                         <?php    
            $output = ob_get_clean();
           // wp_send_json_success(['sid' => $sid]);
                return $output;
    
                }
    //End Question List Code
    
         // Survey List Code
        else{
            include "question-form/survey_list.php"; 
             
        }
      
           //  End Survey List Code 
    
      // die($user_batch_id[0]);
       return $output;
      
       wp_die();
    }
}

   
   

