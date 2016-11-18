<?php 
    /*
      Plugin Name: Registratie Formulier
      Version: 1.0 
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl 
      Description: Dit is een registratieformulier 
   */
   ob_start();
   
   function show_form()
   {
      global $wpdb;

      if (isset($_POST["submit"]))
      {
         //echo "Er is op de knop gedrukt";
         //var_dump($_POST);
         //var_dump($_SERVER);
         
         $wpdb->query(
            $wpdb->prepare("INSERT INTO `wp_users` (`ID`,
                                                    `user_login`,
                                                    `user_pass`,
                                                    `user_email`,
                                                    `user_registered`,
                                                    `user_status`,
                                                    `display_name`)
                            VALUES                (NULL,
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s')",
                                                   $_POST['login'],
                                                   MD5('geheim'),
                                                   $_POST['email'],
                                                   date('Y-m-d H:i:s'),
                                                   0,
                                                   $_POST['login'])
         );

         $id = $wpdb->insert_id;
         
         $userdata = array(
               'ID' => $id,
               'user_login' => $_POST['login'],
               'role' => 'subscriber',
               'user_nicename' => $_POST['login']
         );

         $user_id = wp_insert_user($userdata);
         if ( ! is_wp_error( $user_id ) )
         {            
            echo "U bent geregistreerd. Uw ID: ". $user_id;
            header("Refresh: 2; url=http://localhost/2016-2017/am1b/groenten/");
         }

      }
      else
      {
         $output  = "<form action='".esc_url($_SERVER['PHP_SELF'])."' method='post'>";
         $output .= "<table id='register'>";
         $output .= "<tr><td>voornaam</td><td><input type='text' name='firstname'></td></tr>";
         $output .= "<tr><td>tussenvoegsel</td><td><input type='text' name='infix'></td></tr>";
         $output .= "<tr><td>achternaam</td><td><input type='text' name='lastname'></td></tr>";
         $output .= "<tr><td>login-naam</td><td><input type='text' name='login'></td></tr>";
         $output .= "<tr><td>e-mail</td><td><input type='text' name='email'></td></tr>";
         $output .= "<tr><td></td><td><input type='submit' name='submit' value='registreer!'></td></tr>";
         $output .= "</table>";
         $output .= "</form>";
         return $output;
      }
   }

   add_shortcode("form", "show_form");
?>

