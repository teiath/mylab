<?php
require_once ('server/system/config.php');
require_once ('server/libs/phpCAS/CAS.php');
global $casOptions;


phpCAS::client(SAML_VERSION_1_1 ,$casOptions["Url"],$casOptions["Port"],'',false);
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication(); 

// Handle logout requests
if (isset($_REQUEST['logout'])) {
        phpCAS::logout();
}


?>

<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>

    <p>the user's login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    <p>the attributes are:
    <?php
    var_dump(phpCAS::getAttributes());
//    echo '<ul>';
//    $attr = phpCAS::getAttributes();
//    foreach ($attr as $key => $value)
//    {
//        if(!is_array($value))
//        {
//                echo '<li>' . $key . ' => ' . $value . '</li>';
//        }
//        else
//        {
//                echo '<li>' . $key . '</li>';
//                echo '<ul>';
//                foreach($value as $v)
//                {
//                        echo '<li>' . $v . '</li>';
//                }
//                echo '</ul>';
//        }
//    }
//    echo '</ul>';
    ?>

    </p>
    <p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
    <p><a href="?logout=">Logout</a></p>

  </body>
</html>