<?php 

 if(isset($_GET['action'])){
    if($_GET['action']=='add')
    {
        include "add_q.php";
    }
     else if($_GET['action']=='edit')
      {
         include "edit_q.php";
         }
         else if($_GET['action']=='delete')
         {
            include "delete_q.php";
            }
}
else
{
    include "display_q.php";
}

?>