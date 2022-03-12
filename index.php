<?php
    session_start();
    require_once('controllerDatabase.php');
    require('layouts/header.php');
?>

<div class="main-container">
    <?php
        if(!isset($_GET['page']) || $_GET['page'] == 'index'){
            require('layouts/homepage.php');
        } else {
            switch ($_GET['page']) {
                case 'registrationpage':
                    require 'layouts/registrationpage.php';
                break;

                case 'itemspage':
                    require('layouts/itemspage.php');
                break;

                case 'iteminfopage':
                    require('layouts/iteminfopage.php');
                break;

                case 'fileuploadpage':
                    require('layouts/fileuploadpage.php');
                break;

                case 'confrimregistration':
                    if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
                        require('layouts/confrimregistration.php');
                    } else {
                        require('layouts/notfoundpage.php');
                    }
                break;

                default:
                    require('layouts/notfoundpage.php');
                break;
            }
        }
    ?>
</div>

<?php
    require('layouts/footer.php');
?>