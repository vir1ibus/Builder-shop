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
                case 'itemspage':
                    require('layouts/itemspage.php');
                break;

                case 'iteminfopage':
                    require('layouts/iteminfopage.php');
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