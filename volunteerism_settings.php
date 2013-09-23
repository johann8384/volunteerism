  <?php 
    if($_POST['volunteerism_hidden'] == 'Y') {
      //Form data sent
      $dbhost = $_POST['volunteerism_dbhost'];
      update_option('volunteerism_dbhost', $dbhost);
      
      $dbname = $_POST['volunteerism_dbname'];
      update_option('volunteerism_dbname', $dbname);
      
      $dbuser = $_POST['volunteerism_dbuser'];
      update_option('volunteerism_dbuser', $dbuser);
      
      $dbpwd = $_POST['volunteerism_dbpwd'];
      update_option('volunteerism_dbpwd', $dbpwd);
?>
      <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php
    } else {
      //Normal page display
      $dbhost = get_option('volunteerism_dbhost');
      $dbname = get_option('volunteerism_dbname');
      $dbuser = get_option('volunteerism_dbuser');
      $dbpwd = get_option('volunteerism_dbpwd');
?>
  
    <div class="wrap">
      <?php    echo "<h2>" . __( 'Volunteerism Display Options', 'volunteerism_trdom' ) . "</h2>"; ?>
      
      <form name="volunteerism_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="volunteerism_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Volunteerism Database Settings', 'volunteerism_trdom' ) . "</h4>"; ?>
        <p><?php _e("Database host: " ); ?><input type="text" name="volunteerism_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
        <p><?php _e("Database name: " ); ?><input type="text" name="volunteerism_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: volunteering" ); ?></p>
        <p><?php _e("Database user: " ); ?><input type="text" name="volunteerism_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
        <p><?php _e("Database password: " ); ?><input type="text" name="volunteerism_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>
        <hr />
        <?php    echo "<h4>" . __( 'Volunteerism Class Settings', 'volunteerism_trdom' ) . "</h4>"; ?>
        <p><?php _e("Allow Non-Member Signups: " ); ?><input name="allow_signups" value="<?php echo $allow_signups; ?>" type="checkbox"><?php _e(" This option controls whether or not non-registered users may signup for projects." ); ?></p>

        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'volunteerism_trdom' ) ?>" />
        </p>
      </form>
    </div>
<?php
    }
?>  
