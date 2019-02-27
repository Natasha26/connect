<?php
class HomeController extends Controller
{
    const ADMIN_LOGIN = 'admin';
    const ADMIN_PASSWORD = '1';
    
    public function actionIndex($parameters = []) 
    {
      $breadcrumbs[] = ["url" => "/", "text" => "Home"];
      $this->breadcrumbs = $breadcrumbs;
      $this->render('home');
    }  

    
    public function actionLogin($parameters = [])
    {
        if (self::checkLogin()) {
            header('Location: /');
            die;
        }
        $this->render('login');
    }

    public function actionLogout()
    {
        session_destroy();
        header('Location: /login');
        die;
    }
    
    public function actionPage404($parameters = [])
    {
        $this->render('page404');
    }
    
    protected function checkLogin() 
    {
        if ($_SESSION['admin']) {
            return true;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['login'] === self::ADMIN_LOGIN &&
                $_POST['password'] === self::ADMIN_PASSWORD) {
                $_SESSION['admin'] = true;
                $this->admin = true;
                return true;
            } else {
                $this->log['errors'][] = 'Неуспішний вхід. Спробуйте ще раз.';
            }
        }
        return false;
    }

}