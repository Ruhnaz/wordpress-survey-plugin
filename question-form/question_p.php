<?php 

                            $question_number = isset($_GET['question_number']) ? intval($_GET['question_number']) : 0;
                            //  $question_number;
                            $sid = isset($_GET['sid']) ? sanitize_text_field($_GET['sid']) : '';
                            global $wpdb,$table_prefix;
                           
                             
                            
                            $tblname = 'smp_question';
                            $wp_track_table = $table_prefix . "$tblname";
                            $que="SELECT * FROM {$wp_track_table} where survey_id=$sid";
                           
                            $result = $wpdb->get_results( $que);
                           // echo"<pre>";
                           // print_r($result);
                            //echo"</pre>";
                            $tblname = 'smp_survey';
                            $wp_track_table = $table_prefix . "$tblname";
                            $q4="SELECT * FROM {$wp_track_table} where surveyid=$sid";
                           
                            $r4 = $wpdb->get_results( $q4);
                      
                            $count = count( $result,1);
                            $question = $result[$question_number];
                          
                            $userid = wp_get_current_user();
                            $tblname = 'smp_survey_options';
                                                $wp_track_table = $table_prefix . "$tblname";
                                                $q1="SELECT * FROM {$wp_track_table} where question_id= $question->id";
                                               // print_r($question);
                                            
                                                $r1 = $wpdb->get_results($q1);
                                                //print_r($r1);
                                                $tblname = 'smp_answers';
                                                $wp_track_table = $table_prefix . "$tblname";
                                               $q2="SELECT * FROM {$wp_track_table} where question_id = $question->id AND user_id = $userid->ID;";
                                                $r2 = $wpdb->get_results($q2);
                                                $output.= '';
                                                $qno= $question_number+1;
 //check language settings
  // echo"<pre>";
                          // print_r($r2);
                          // echo"</pre>";

                            $current_language = get_locale();

                          


                            if($current_language != 'en_US'){
                              if($current_language == 'mr'){
                                $languageid = 3;
                                $Skip ="वगळा" ;
                                $Next= "पुढे";
                                $Question= "सवाल";
                                $Survey="सर्वेक्षण";
                                $questionlist = "प्रश्न सूची";
                              }
                              if($current_language == 'fr_FR'){
                                $languageid = 2;
                                  $Skip = "Sauter";
                                $Next= "Suivant";
                                $Question= "Question";
                                $Survey= "Enquête";
                                $questionlist="Liste de questions";
                              }
                              if($current_language == 'hi_IN'){
                                $languageid = 1;
                               $Skip =" इसे छोड़ दें";
                                $Next= "अगला"; 
                               $Question= "प्रश्न";
                         $Survey= "सर्वे";
                         $questionlist="प्रश्न सूची";
                              }
                            
                              $tblname = 'smp_questions_translations';
                            $wp_track_table = $table_prefix . "$tblname";
                            $lang_query="SELECT * FROM {$wp_track_table} where questionid=$question->id";
                           
                            $lang = $wpdb->get_results( $lang_query);

                            $tblname = 'smp_options_translations';
                            $wp_track_table = $table_prefix . "$tblname";
                            $lang_o_query="SELECT * FROM {$wp_track_table} where questionid=$question->id AND languageid=$languageid;";
                           
                            $lang_o = $wpdb->get_results( $lang_o_query);
                            }
                            //$count = count($result,1);
                           // if($current_language != 'en_US' &&   count( $lang_o,1) ==  count( $r1,1) ){
                           
                            if($current_language != 'en_US' ){
                            $ans = ""; 
                              if(!empty($r2)) {$ans= $r2[0];}
                                if(($question->optiontype == 0 || $question->optiontype == 1) && count( $lang,1)>0){
                              $output.= '   <div class="section-one" ><h4>'. $questionlist.' </h4> <div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><p>'.$Survey.'-'.$r4[0]->name.'</p><div class="d-flex justify-content-between"><form>'.$Question.'->'.$qno.'/'.$count.'<br><h5>'. $lang[0]->question_translation.'</h5>
                              <input type="hidden" value="'. $question->id.'" class="hidden_qid">
                              <input type="hidden" value="'. $sid.'" class="hidden_sid">
                              <input type="hidden" value="'. $count.'" class="count">
                              <input type="hidden" value="'. $question->optiontype.'" class="type">
                              </div><div class="msg"></div><div class="mbq-5">';
                              if($question->optiontype == 0){
                                $output.= '<div class="d-flex form-input"><input type="text" name="customtext" value="'.$ans->options.'" class="form-text-field" id="txtfield"></div>';
                               }
                               if($question->optiontype == 1){
                                $output.= '<div class="d-flex form-input"><textarea name="customarea" class="form-text-field ans" id="txtArea" >'.$ans->options.'</textarea></div>';
                               }
                               $output.= '</div><div class="required_class"> </div></div>';
                               $output.= ' <button type="submit" value="Skip" class="save-btn skip-btn"   />'.$Skip.'
                               <button type="submit" value="Next" class="save-btn next-btn" onclick=""  />'.$Next.'
                              </div></div>';
                                }
                                 if(($question->optiontype == 0 || $question->optiontype == 1) &&  sizeof($lang) == 0 ){
                                   $output.= '<div class="section-one" ><h4>Question List </h4><div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><p>Survey-'.$r4[0]->name.'</p><div class="d-flex justify-content-between"><form>Question ->'.$qno.'/'.$count.'<br><h5>'. $question->des.'</h5>
                            <input type="hidden" value="'. $question->id.'" class="hidden_qid">
                            <input type="hidden" value="'. $sid.'" class="hidden_sid">
                            <input type="hidden" value="'. $count.'" class="count">
                            <input type="hidden" value="'. $question->optiontype.'" class="type">
                            </div><div class="msg"></div><div class="mbq-5">';
                           if($question->optiontype == 0){
                                $output.= '<div class="d-flex form-input"><input type="text" name="customtext" value="'.$ans->options.'" class="form-text-field ans" id="txtfield"></div>';
                               }
                               if($question->optiontype == 1){
                                $output.= '<div class="d-flex form-input"><textarea name="customarea" class="form-text-field ans" id="txtArea">'.$ans->options.'</textarea></div>';
                               }
                                $output.= '</div><div class="required_class"> </div></div>';
                           $output.= ' <button type="submit" value="Skip" class="save-btn skip-btn"  />Skip
                           <button type="submit" value="Next" class="save-btn next-btn" onclick="" />Next
                          </div></form></div>';
                                 }
                                if( ($question->optiontype != 0 && $question->optiontype != 1) && (count( $lang_o,1) == count( $r1,1)) ){
                                  $output.= '   <div class="section-one" ><h4>'. $questionlist.' </h4> <div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><p>'.$Survey.'-'.$r4[0]->name.'</p><div class="d-flex justify-content-between"><form>'.$Question.'->'.$qno.'/'.$count.'<br><h5>'. $lang[0]->question_translation.'</h5>
                                  <input type="hidden" value="'. $question->id.'" class="hidden_qid">
                                  <input type="hidden" value="'. $sid.'" class="hidden_sid">
                                  <input type="hidden" value="'. $count.'" class="count">
                                  <input type="hidden" value="'. $question->optiontype.'" class="type">
                                  </div><div class="msg"></div><div class="mbq-5">';
                                  foreach($lang_o as $l){
                             
                                    if(($question->optiontype == 2 || $question->optiontype == 3)){
                                     $checked ="";
                                     if($ans != ""){
                                        
                                         if($l->optionid == $ans->options) {$checked = "checked";}
                               
                                       }
                                       
                                         $output.= '<div class="d-flex form-input"><label class="label-custom"><input type ="radio" name="radio"  value="'.$l->optionid.'"'.$checked.' class="radio" >
                                         <span>'.$l->options_translation.' </span> </label></div>';
                                    
                     
                                    }
   
                                    if($question->optiontype == 4){
                                     $arr= [];  
                                     for($k=0; $k<count($r2); $k++){
                                       array_push($arr,$r2[$k]->options) ;
                                      
                                     }  
                                     $checked ="";
                                     if(in_array($l->optionid,$arr)) {$checked = "checked";}
                                    
                                     $output.= '<div class="d-flex form-input"><label> <input type ="checkbox" class="checkval" name="check[]" value="'.$l->optionid.'"'.$checked.' >
                                     <span>'.$l->options_translation.' </span></label></div>';
                                    }
                                   
                                 }
                                 $output.= '</div><div class="required_class"> </div></div>';
                                 $output.= ' <button type="submit" value="Skip" class="save-btn skip-btn"   />'.$Skip.'
                                 <button type="submit" value="Next" class="save-btn next-btn" onclick=""  />'.$Next.'
                                </div></div>';
                                }
                             // print_r($r2);
                             if( ($question->optiontype != 0 && $question->optiontype != 1) && (count( $lang_o,1) != count( $r1,1)) ){
                             $output.= '<div class="section-one" ><h4>Question List </h4><div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><p>Survey-'.$r4[0]->name.'</p><div class="d-flex justify-content-between"><form>Question ->'.$qno.'/'.$count.'<br><h5>'. $question->des.'</h5>
                            <input type="hidden" value="'. $question->id.'" class="hidden_qid">
                            <input type="hidden" value="'. $sid.'" class="hidden_sid">
                            <input type="hidden" value="'. $count.'" class="count">
                            <input type="hidden" value="'. $question->optiontype.'" class="type">
                            </div><div class="msg"></div><div class="mbq-5">';
                          
                            
                           // print_r($r2);
                            $ans = ""; 
                            
                            if(!empty($r2)) {$ans= $r2[0];}
                            if($question->optiontype == 0){
                            
                             $output.= '<div ><input type="text" name="customtext" value="'.$ans->options.'" class="form-text-field ans"id="txtfield" ></div>';
                            }
                            if($question->optiontype == 1){
                              $output.= '<div><textarea name="customarea" class="form-text-field ans" id="txtArea">'.$ans->options.'</textarea></div>';
                             }
                           foreach($r1 as $r){
                              
                             
                              if(($question->optiontype == 2 || $question->optiontype == 3)){
                               $checked ="";
                               if($ans != ""){
                                  
                                   if($r->id == $ans->options) {$checked = "checked";}
                         
                                 }
                                 
                                   $output.= '<div class="d-flex form-input"><label class="label-custom"><input type ="radio" name="radio"  value="'.$r->id.'"'.$checked.' class="radio" >
                                   <span>'.$r->name.' </span> </label></div>';
                              
               
                              }
                              if($question->optiontype == 4){
                               $arr= [];  
                               for($k=0; $k<count($r2); $k++){
                                 array_push($arr,$r2[$k]->options) ;
                                
                               }  
                               $checked ="";
                               if(in_array($r->id,$arr)) {$checked = "checked";}
                              
                               $output.= '<div class="d-flex form-input"><label class="label-custom"> <input type ="checkbox" class="checkval" name="check[]" value="'.$r->id.'"'.$checked.' >
                               <span>'.$r->name.' </span></label></div>';
                              }
                             
                           }
                              
                 
               
                           
                           $output.= '</div><div class="required_class"> </div></div>';
                           $output.= ' <button type="submit" value="Skip" class="save-btn skip-btn"  />Skip
                           <button type="submit" value="Next" class="save-btn next-btn" onclick="" />Next
                          </div></form></div>';
                            }
                             
   
                    
                            }          
                                               
                          else{
                            $output.= '<div class="section-one" ><h4>Question List </h4><div  class="box"><input type="button" value="X" class="cansel-btn" onclick="javascript: history.go(-1)"/><p>Survey-'.$r4[0]->name.'</p><div class="d-flex justify-content-between"><form>Question ->'.$qno.'/'.$count.'<br><h5>'. $question->des.'</h5>
                            <input type="hidden" value="'. $question->id.'" class="hidden_qid">
                            <input type="hidden" value="'. $sid.'" class="hidden_sid">
                            <input type="hidden" value="'. $count.'" class="count">
                            <input type="hidden" value="'. $question->optiontype.'" class="type">
                            </div><div class="msg"></div><div class="mbq-5">';
                          
                            
                           // print_r($r2);
                            $ans = ""; 
                            
                            if(!empty($r2)) {$ans= $r2[0];}
                            if($question->optiontype == 0){
                            
                             $output.= '<div ><input type="text" name="customtext" value="'.$ans->options.'" class="form-text-field ans" id="txtfield"></div>';
                            }
                            if($question->optiontype == 1){
                              $output.= '<div><textarea name="customarea" class="form-text-field ans" id="txtArea">'.$ans->options.'</textarea></div>';
                             }
                           foreach($r1 as $r){
                              
                             
                              if(($question->optiontype == 2 || $question->optiontype == 3)){
                               $checked ="";
                               if($ans != ""){
                                  
                                   if($r->id == $ans->options) {$checked = "checked";}
                         
                                 }
                                 
                                   $output.= '<div class="d-flex form-input"><label class="label-custom"><input type ="radio" name="radio"  value="'.$r->id.'"'.$checked.' class="radio" >
                                   <span>'.$r->name.' </span> </label></div>';
                              
               
                              }
                              if($question->optiontype == 4){
                               $arr= [];  
                               for($k=0; $k<count($r2); $k++){
                                 array_push($arr,$r2[$k]->options) ;
                                
                               }  
                               $checked ="";
                               if(in_array($r->id,$arr)) {$checked = "checked";}
                              
                               $output.= '<div class="d-flex form-input"><label class="label-custom"> <input type ="checkbox" class="checkval" name="check[]" value="'.$r->id.'"'.$checked.' >
                               <span>'.$r->name.' </span></label></div>';
                              }
                             
                           }
                              
                 
               
                           
                           $output.= '</div><div class="required_class"> </div></div>';
                           $output.= ' <button type="submit" value="Skip" class="save-btn skip-btn"  />Skip
                           <button type="submit" value="Next" class="save-btn next-btn" onclick="" />Next
                          </div></form></div>';
                          }                      
                                              
                  