<?php 

 if(isset($_GET['action'])){
    if($_GET['action']=='add')
    {
        include "add_section.php";
    }
     else if($_GET['action']=='edit')
      {
         include "edit_section.php";
         }
         else if($_GET['action']=='delete')
      {
         include "delete_section.php";
         }
}
else
{
    include "display_section.php";
}

?>