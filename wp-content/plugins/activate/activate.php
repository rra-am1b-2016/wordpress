<?php
   /*
      Plugin Name: activatie van het account
      Version: 1.0 
      Author: Arjan de Ruijter
      Author URI: https://arjanderuijter.nl 
      Description: Activatieplugin werkt samen met registrationform 
   */

function activate()
{
   if ( isset($_POST["submit"]) )
   {         
       // Vraag de gegevens op van de user uit de database
       $user_info = get_userdata( $_POST["id"] );

       //var_dump($user_info); 
       //echo $user_info->data->user_pass;
       //exit();

       /*
       var_dump($user_info);
       echo  "Post password: ".$_POST["password"]."<br>";
       echo "Password hash door functie: ".wp_hash_password($_POST["password"])."<br>";
       echo "post hidden pw: ".$_POST["pw"]."<br>";
       echo "user_info->data->user_pass: ".$user_info->data->user_pass."<br>";
       
       //exit();
       */


       if (strcmp($_POST["pw"], $user_info->data->user_pass) == 0) 
       {     
            if (strcmp($_POST["password"], $_POST["verification_password"]) == 0)
            {
                  // dan updaten we het password veld naar de nieuwe waarde en zetten we activate op true.

                   //var_dump($user_info); 
                  //echo "Dit is mijn databasepassword: ".$user_info->data->user_pass;
                  //echo "Dit is mijn nieuwe password: ". $_POST["password"];
                  //exit();

                  $user_id = wp_set_password( $_POST["password"], $_POST["id"] );

                 

                  //var_dump($user_id); exit();
                  if ( ! is_wp_error( $user_id ) )
                  { 
                        echo "Uw account is geactiveerd en uw password gewijzigd.";
                        header("refresh: 4; url=http://localhost/2016-2017/am1b/groenten/");
                  } 
            }
            else
            {
                  echo "De twee ingevoerde wachtwoorden komen niet overeen. Probeer het nog een keer.<br>";
                  echo "U wordt doorgestuurd naar de betreffende pagina";
                  header("refresh: 4; url=http://localhost/2016-2017/am1b/groenten/index.php/activatie/?content=activate&id=".$_POST["id"]."&pw=".MD5("geheim")."'");
            }
       }
       else
       {
            echo "U heeft geen rechten op deze pagina<br>";
            echo "U wordt doorgestuurd";
            header("refresh: 4; url=http://localhost/2016-2017/am1b/groenten/");
       }
   }
   else
   {
?>
<h2>Wijzig uw wachtwoord</h2>
<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post">
   <table>
      <tr>
         <td>Wachtwoord:</td>
         <td><input type="password" name="password" required></td>
      </tr>
      <tr>
         <td>Tik opnieuw in:</td>
         <td><input type="password" name="verification_password" required></td>
      </tr>
      <tr>
         <td></td>
         <td><input type="submit" name="submit" value="wijzig!"></td>
      </tr>
      <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
      <input type="hidden" name="pw" value="<?php echo $_GET["pw"]; ?>">
   </table>
</form>
<?php
   }
}
add_shortcode("activate", "activate");
?>