<?php
class GroupController extends Controller
{
  
    public function actionList($parameters = []) 
    {
        $params['groups'] = Group::getGroups();
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/groups", "text" => "Groups"];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('list', $params);
    }
    
    public function actionView($parameters = []) 
    {
        $groupId = $parameters[0];
        $group = new Group($groupId);
        $params['group'] = $group;
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/establishment/{$group->establishmentId}", "text" => $group->establishmentShortName];
        $breadcrumbs[] = ["url" => "/department/{$group->departmentId}", "text" => $group->departmentShortName];
        $breadcrumbs[] = ["url" => "/group/{$group->groupId}", "text" => $group->groupName];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('view', $params);
    }
    
    public function actionEdit($parameters = [])
    {
      $group = new Group($parameters[0]);
      
      if (isset($_POST['action'])) {
        if (strlen($_POST['group_name']) <= 2) {
          $this->messages['danger'][] = "Group Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $group->initObjectFromArray($_POST);
          if ($group->update()) {
             $_SESSION["flash"]["success"][] = "Group successfully updated";
           } else {
             $_SESSION["flash"]["danger"][] = "Group was not updated. Something goes wrong";
           }
          header("Location: /group/{$group->groupId}");
        }    
      }
      $params['group'] = $group;
      $params['action'] = "edit";
      $params['path'] = "edit/$group->groupId";
      $params['departments'] = Department::getDepartments();
      $this->render('form', $params);
    }
      
    public function actionAdd($parameters = [])
    {
      $group = new Group();
      if (isset($_POST['action'])) {
        if (strlen($_POST['group_name']) <= 2) {
          $this->messages['danger'][] = "Group Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $group->initObjectFromArray($_POST);
          if ($group->create()) {
            $_SESSION["flash"]["success"][] = "Group successfully created";
          } else {
            $_SESSION["flash"]["danger"][] = "Group was not created. Something goes wrong";
          }
          header("Location: /group/{$group->groupId}");
        }
      }
      $params['group'] = $group;
      $params['action'] = "add";
      $params['path'] = "add";
      $params['departments'] = Department::getDepartments();
      $this->render('form', $params);
    }

}