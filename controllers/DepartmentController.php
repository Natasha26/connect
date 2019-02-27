<?php
class DepartmentController extends Controller
{
  
    public function actionList($parameters = []) 
    {
        $params['departments'] = Department::getDepartments();
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/departments", "text" => "Departments"];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('list', $params);
    }
    
    public function actionView($parameters = []) 
    {
        $departmentId = $parameters[0];
        $department = new Department($departmentId);
        $params['department'] = $department;
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/establishment/{$department->establishmentId}", "text" => $department->establishmentShortName];
        $breadcrumbs[] = ["url" => "/department/{$department->departmentId}", "text" => $department->shortName];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('view', $params);
    }
       
    public function actionEdit($parameters = [])
    {
      $department = new Department($parameters[0]);
      if (isset($_POST['action'])) {
        if (strlen($_POST['department_name']) <= 2) {
          $this->messages['danger'][] = "Department Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $department->initObjectFromArray($_POST);
          if ($department->update()) {
            $_SESSION["flash"]["success"][] = "Department successfully updated";
          } else {
            $_SESSION["flash"]["danger"][] = "Department was not updated. Something goes wrong";
          }
          header("Location: /department/{$department->departmentId}");
        }
      }
      $establishments = Establishment::getEstablishments();
      $params['department'] = $department;
      $params['action'] = "edit";
      $params['path'] = "edit/$department->departmentId";
      $params['establishments'] = $establishments;
      $this->render('form', $params);
    }

    public function actionAdd($parameters = [])
    {
      $department = new Department();
      if (isset($_POST['action'])) {
        if (strlen($_POST['department_name']) <= 2) {
          $this->messages['danger'][] = "Department Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $department->initObjectFromArray($_POST);
          if ($department->create()) {
            $_SESSION["flash"]["success"][] = "Department successfully created";
          } else {
            $_SESSION["flash"]["danger"][] = "Department was not created. Something goes wrong";
          }
          header("Location: /department/{$department->departmentId}");
        }
      }
      $establishments = Establishment::getEstablishments();
      $params['department'] = $department;
      $params['action'] = "add";
      $params['path'] = "add";
      $params['establishments'] = $establishments;
      $this->render('form', $params);
    }    
    
}