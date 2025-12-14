<?php 

 if(isset($_GET['action'])){
    if($_GET['action']=='add')
    {
        include "add_survey.php";
    }
     else if($_GET['action']=='edit')
      {
         include "edit_survey.php";
         }
         else if($_GET['action']=='delete')
         {
            include "delete_survey.php";
            }
}
else
{
    include "display_survey.php";
}

?>