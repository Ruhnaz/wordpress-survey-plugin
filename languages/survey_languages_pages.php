<?php 

 if(isset($_GET['action'])){
    if($_GET['action']=='add')
    {
        include "add_language.php";
    }
     else if($_GET['action']=='edit')
      {
         include "edit_language.php";
         }
}
else
{
    include "display_language.php";
}

?>