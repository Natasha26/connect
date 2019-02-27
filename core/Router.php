<?php
//Класс Router
class Router
{
    //Статичний метод Route() для знаходження маршруту
    public static function Route(){
        //Підключимо таблицю маршрутів в масив $routes
        $routes = include(ROOT."/config/routes.php");
        //Визначаємо рядок запиту
        $uri = trim($_SERVER["REQUEST_URI"], "/");
        //Ініціалізуємо рядок шляху
        $path = "home/page404";
        //Для кожного елементу з $routes
        foreach($routes as $key => $route){
            //Якщо $key співпав із $uri по шаблону
            if(preg_match("*^$key$*", $uri)){
                //Робимо заміну рядка $uri рядком $route
                $path = preg_replace("*$key*", $route, $uri);
                break;
            }
        }
        return $path;
    }
}
