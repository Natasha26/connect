<?php
class UserController extends Controller
{
  
    public function actionList($parameters = []) 
    {
        $params['users'] = User::getUsers();
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/users", "text" => "Users"];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('list', $params);
    }
    
    public function actionView($parameters = []) 
    {
        $userId = $parameters[0];
        $user = new User($userId);
        $params['user'] = $user;
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/establishment/{$user->establishmentId}", "text" => $user->establishmentShortName];
        $breadcrumbs[] = ["url" => "/department/{$user->departmentId}", "text" => $user->departmentShortName];
        $breadcrumbs[] = ["url" => "/group/{$user->groupId}", "text" => $user->groupName];
        $breadcrumbs[] = ["url" => "/user/{$user->userId}", "text" => $user->firstName . " " . $user->lastName];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('view', $params);
    }
          
    public function actionEdit($parameters = [])
    {
      $user = new User($parameters[0]);
      
      if (isset($_POST['action'])) {
        
        if (strlen($_POST['first_name']) <= 2) {
          $this->messages['danger'][] = "First Name must have more than 2 chars";
        }
        if (strlen($_POST['last_name']) <= 2) {
          $this->messages['danger'][] = "Last Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $user->initObjectFromArray($_POST);
          if ($user->update()) {
            $_SESSION["flash"]["success"][] = "User successfully updated";
          } else {
            $_SESSION["flash"]["danger"][] = "User was not updated. Something goes wrong";
          }
          header("Location: /user/{$user->userId}");
        }
      }
      $params['user'] = $user;
      $params['action'] = "edit";
      $params['path'] = "edit/$user->userId";
      $params['groups'] = Group::getGroups();
      $this->render('form', $params);
    }

    public function actionAdd($parameters = [])
    {
      $user = new User();
      $groupID = (isset($parameters[0]) && ($parameters[0] > 0)) ? $parameters[0] : 0;
      $group = new Group($groupID);
      $user->groupId = $groupID;
      
      if (isset($_POST['action'])) {
        if (strlen($_POST['first_name']) <= 2) {
          $this->messages['danger'][] = "First Name must have more than 2 chars";
        }
        if (strlen($_POST['last_name']) <= 2) {
          $this->messages['danger'][] = "Last Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $user->initObjectFromArray($_POST);
          if ($user->create()) {
            $_SESSION["flash"]["success"][] = "User successfully created";
          } else {
            $_SESSION["flash"]["danger"][] = "User was not created. Something goes wrong";
          }
          header("Location: /group/{$user->groupId}");
        }
      }
      
      
      $params['user'] = $user;
      $params['group'] = $group;
      $params['action'] = "add";
      $params['path'] = "add";
      $params['groups'] = Group::getGroups();
      $this->render('form', $params);
    }
    
}