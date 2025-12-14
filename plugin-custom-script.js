jQuery(document).ready(function($){

  var currentQuestion = 0;
  var questionContainer = $('.survey-question');
 
  function loadNextQuestion() {
    //var sid = $.urlParam('sid');
    //var sid = $.url.attr('sid');
    //var sid = "<?php  $_GET['sid']; ?>";
// console.log(sid);
var sid = $('.survey-question').data('id');
console.log(sid);
    $.ajax({
        
        url: ajaxurl,
      
        type: 'GET',
        data: {
            action: 'load_survey_question',
            question_number: currentQuestion,
           sid: sid,
        },
        success: function(response) {
            questionContainer.html(response);
        }
    });
}

function endQuestions(){
    $.ajax({
        
        url: ajaxurl,
      
        type: 'GET',
        data: {
            action: 'end_survey_question',
           
        },
        success: function(response) {
            questionContainer.html("");
            $('.survey-question').html(response);
        }
    }); 
}
  
jQuery(document).on('click', '.survey_data', function (e) {

    var sid = $(this).data("sid");
    console.log(sid);
     
    $.ajax({
        
        url: ajaxurl,
      
        type: 'GET',
        data: {
            action: 'load_survey_question',
            question_number: currentQuestion,
          sid: sid,
        },
        success: function(response) {
            questionContainer.html(response);
        }
    });

});



console.log("load");

loadNextQuestion();

jQuery(document).on('click', '.skip-btn', function (e) {
    e.preventDefault();
    currentQuestion++;  
    $(".required_class").html("");
    var count= $(".count").val();
    if(currentQuestion<count){
       
        loadNextQuestion(currentQuestion);
       }
       else{
        endQuestions();
       }
});


                  //  jQuery("#next-btn").on("click", function(e){
                        jQuery(document).on('click', '.next-btn', function (e) {
                        e.preventDefault();
                      
                        var q_id= $(".hidden_qid").val();
                        var sid= $(".hidden_sid").val();
                        var count= $(".count").val();
                       // var type = $(this).data("type");
                        var type= $(".type").val();
                        
                        if(type == "4"){
      
      
                            var optionval = [];
                           
                            $(".checkval").each(function(){
                                if($(this).is(":checked")){
                                    optionval.push($(this).val());
                                }
                                
                            });
                             
                            }
                     if(type== "2" || type=="3"){
                                var optionval= $('input[name="radio"]:checked').val();
                              // var ans = 26;
                              // var ans = $(".radio").val();
                              //var ans = $(".radio:checked").val();
                            }
                          
                            
                            if(type== "0"){
                            //var ans =  $(".ans").val();
                            var optionval = $("#txtfield").val();
                            }
                            
                            if(type== "1"){
                                //var ans =  $(".ans").val();
                                var optionval = $("#txtArea").val();
                                //var ans = $("input:text").val("");
                                }
                            console.log(q_id);
                            console.log(type);
                            console.log(optionval);
                           
                            if (optionval == undefined){
                               
                                    $(".required_class").html("Required*");   
                                 
                               
                            }
                            else{
                                currentQuestion++;  
                                jQuery.ajax({
                                    //url: ajax_object.ajax_url,
                                    url: ajaxurl,
                                     type: "post",
                                     data: {action: "next_btn", optionval : optionval, q_id:q_id,sid: sid,count:count,type:type},
                                     success : function(res){
                                        //$(".section-one").append(res);
                                        
                                     if(currentQuestion<count){
                                         loadNextQuestion(currentQuestion);
                                        }
                                        else{
                                            endQuestions();
                                           }
                                          // $(".section-one").append(res)
                                          // $('.survey-question').html(res);
                                       },
                                       error : function(){
                                       console.log("error");
                                   }
                                   });
                            }
                          }); 
                         
                        });
                  
