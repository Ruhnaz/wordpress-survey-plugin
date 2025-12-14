




    <h1 align="center">SMP Section</h1><form method='post' action='' name='myform' enctype='multipart/form-data'>
    <h2><a class="button" name="but_submit" href="?page=SMP_Section&action=add" style="background-color: #00CC33; color:#FFFFFF"/>New</a>&nbsp;&nbsp;<!--<input type="button" value="Publish" class="button"/>&nbsp;&nbsp;<input type="button" value="Trash" class="button"/>--></h2>
    <!-- Form -->
    <!--<table class="widefat fixed" cellspacing="0">
    <tr><td><input type="text" value="search" />&nbsp;<input type="button" value="search" /></td><td width="35%"></td><td><select><option>Title</option></select>&nbsp;<select><option>Ascending</option></select>&nbsp;<select><option>20</option></select></td></tr>
    <tr><td colspan="3" height="35px"></td></tr>
    </table>
    -->
      <table class="widefat fixed" cellspacing="0" border="0">
      <thead>
        <tr>
       
         <th id="cb" class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Title</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Description</th>
           <th id="columnname" class="manage-column column-columnname" scope="col">Status</th>
             <th id="columnname" class="manage-column column-columnname" scope="col">CreatedDate</th>
          <th id="columnname" class="manage-column column-columnname" scope="col">ID</th>
        </tr>
        </thead>
          <tfoot>
        <tr>
     
                <th class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
                <th class="manage-column column-columnname" scope="col">Title</th>
                <th id="columnname" class="manage-column column-columnname" scope="col">Description</th>
                 <th class="manage-column column-columnname" scope="col">Status</th>
                  <th class="manage-column column-columnname" scope="col">CreatedDate</th>
                <th class="manage-column column-columnname " scope="col">ID</th>
    
        </tr>
        </tfoot>
       <?php  global $table_prefix, $wpdb;
       $row_class="alternate";
          $tblname = 'smp_section';
          $wp_track_table = $table_prefix . "$tblname";
          $que="SELECT * FROM {$wp_track_table}";
          $i=0;
          $result = $wpdb->get_results($que);// print_r($result);
          foreach($result as $row) {
          $status=$row->status;
          $i++;
          if($i%2==0)
          $row_class="";
          else
          $row_class="alternate";
        
    $dt = new DateTime($row->created_date);
    
    $date = $dt->format('d-m-Y');
          ?>
           <tbody>
        <tr class="<?php echo $row_class;?>" id="row_<?php echo $i; ?>">
        <td class="column-columnname"><input type="checkbox" /></td><td class="column-columnname"><a href="#" style="text-decoration:none"><?php echo $row->name; ?></a> <div class="row-actions">
                        <span><a href=?page=SMP_Section&action=edit&id=<?php echo $row->id?>>Edit</a> </span>
                        <span><a href=?page=SMP_Section&action=delete&id=<?php echo $row->id?>>Delete</a> </span>
                     <!--   <span><a href="#">View</a></span>-->
                    </div></td>
              <td class="column-columnname"><?php echo $row->des; ?></td>
                    <td class="column-columnname"><?php if($status=='1') echo "Active"; else if($status=='0') echo "Inactive";?></td>
                    <td class="column-columnname"><?php echo $date;?></td><td class="column-columnname"><?php echo $row->id; ?></td>
        </tr>
        <?php }?>
      
        
         </tbody>
       
       </table> 
    </form>