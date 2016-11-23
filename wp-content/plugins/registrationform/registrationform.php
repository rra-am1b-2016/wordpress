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
      //var_dump($_SERVER); exit();
      global $wpdb;

      if (isset($_POST["submit"]))
      { 
         $wpdb->query(
               $wpdb->prepare("INSERT INTO `wp_users` (`ID`,
                                                    `user_login`,
                                                    `user_pass`,
                                                    `user_nicename`,
                                                    `user_email`,
                                                    `user_url`,
                                                    `user_registered`,
                                                    `user_activation_key`,
                                                    `user_status`,
                                                    `display_name`)
                            VALUES                (NULL,
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%s',
                                                   '%d',
                                                   '%s')",
                                                   $_POST['login'],
                                                   MD5('geheim'),
                                                   $_POST['login'],
                                                   $_POST['email'],
                                                   "",
                                                   date('Y-m-d H:i:s'),
                                                   "",
                                                   0,
                                                   $_POST['login'])
               );
      
         
         // Vraag het id op van het laatst ingevoerde record.
         $id = $wpdb->insert_id;
         

         $userdata = array(
               'ID' => $id,
               'user_login' => $_POST['login'],
               'role' => 'subscriber',
               'user_nicename' => $_POST['login'],
               'user_email' => $_POST['email']
         );

         //var_dump($userdata); exit();

         $user_id = wp_insert_user($userdata);

         if ( ! is_wp_error( $user_id ) )
         {   
            $to = $_POST["email"];
            $subject = "Activatielink voor inloggen";
            $message = "<!DOCTYPE html>
                        <html>
                              <head>
                                    <title>Registratie</title>
                                    <style>
                                       body
                                       {
                                          color: green;
                                          
                                       }
                                       a 
                                       {
                                          color: yellow;
                                          font-size: 3em;
                                       } 
                                    </style>
                              </head>
                              <body>
                                  <p>Geachte mevrouw/heer ".$_POST["firstname"]." ".$_POST["infix"]." ".$_POST["lastname"]."</p>".
                                  "Bedankt voor het registreren. Om het registratieproces<br>". 
                                  "te voltooien moet u op de onderstaande link klikken<br>". 
                                  "<a href='http://localhost/2016-2017/am1b/groenten/index.php/activatie/?id=".$id."&pw=".MD5("geheim")."'>registratielink</a> <br>".
                                  "<p>Met vriendelijke groet,</p>".
                                  "Administrator                        
                              </body>
                        </html>";
            $headers = "Content-Type: text/html; charset=UTF-8"."\r\n";
            $headers .= "Cc: admin@gmail.com, root@gmail.com"."\r\n";
            $headers .= "Bcc: belastingdienst@gmail.com"."\r\n";
            $headers .= "From: admin@groenten.com";
            mail($to, $subject, $message, $headers);
            // Boodschap dat het registratieproces is voltooid
            echo "Er wordt een registratiemail gestuurd naar het door u opgegeven mailadres.";
            echo "Na het klikken op de activatielink is het registratieproces voltooid";
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

