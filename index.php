<?php
    session_start();
    require_once('service_scripts/controller-database.php');

    if(!isset($_SESSION['authorized'])) {
        $_SESSION['authorized'] = false;
    }

    if(!isset($_COOKIE['token']) && isset($_SESSION['token'])) {
        setcookie('token', $_SESSION['token'], time() + 3600);
    }

    if(isset($_COOKIE['token']) && !isset($_SESSION['token'])) {
        $_SESSION['token'] = $_COOKIE['token'];
    }

    if(isset($_SESSION['token'])) {
        $now = date_create();
        date_timestamp_set($now, time());
        $now_str = date_format($now, 'Y-m-d H:i:s');
        $sql = "SELECT user_id FROM user_token WHERE token = '".$_SESSION['token']."' AND time_expired > '${now_str}';";
        $result = mysqli_query($connect_db, $sql);
        if(!mysqli_num_rows($result)) {
            unset($_SESSION['token'], $_SESSION['user_id'], $_SESSION['username']);
            setcookie('token', null, -1);
            $token = null;
            $_SESSION['authorized'] = false;
        } else {
            $row = mysqli_fetch_array($result);
            $sql = "SELECT id, username FROM user WHERE id = ${row['user_id']};";
            $result = mysqli_query($connect_db, $sql);
            $row = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['authorized'] = true;
        }
    } else {
        $_SESSION['authorized'] = false;
    }

    require('layouts/header.php');
?>

<div class="main-container">
    <?php
        if(!isset($_GET['page']) || $_GET['page'] == 'index'){
            require('layouts/home-page.php');
        } else {
            switch ($_GET['page']) {
                case 'personal-account-page':
                    if($_SESSION['authorized']) {
                        require('layouts/personal-account-page.php');
                    } else {
                        require('layouts/authorization-page.php');
                    }
                break;

                case 'authorizationpage':
                    if($_SESSION['authorized']) {
                        require('layouts/home-page.php');
                    } else {
                        require('layouts/authorization-page.php');
                    }
                break;

                case 'registrationpage':
                    require('layouts/registration-page.php');
                break;

                case 'itemspage':
                    require('layouts/items-from-category-page.php');
                break;

                case 'iteminfopage':
                    require('layouts/item-info-page.php');
                break;

                case 'fileuploadpage':
                    require('layouts/fileuploadpage.php');
                break;

                case 'confrimregistration':
                    if(isset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg'])) {
                        require('layouts/confirm-registration-page.php');
                    } else {
                        require('layouts/not-found-page.php');
                    }
                break;

                default:
                    require('layouts/not-found-page.php');
                break;
            }
        }
    ?>
</div>

<?php
    require('layouts/footer.php');
?>