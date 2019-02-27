<?php
class EstablishmentController extends Controller
{
  
    public function actionList($parameters = []) 
    {
        $params['establishments'] = Establishment::getEstablishments();
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/establishments", "text" => "Establishments"];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('list', $params);
    }
    
    public function actionView($parameters = []) 
    {
        $establishmentId = $parameters[0];
        $establishment = new Establishment($establishmentId);
        $params['establishment'] = $establishment;
        $breadcrumbs[] = ["url" => "/", "text" => "Home"];
        $breadcrumbs[] = ["url" => "/establishment/{$establishment->establishmentId}", "text" => $establishment->shortName];
        $this->breadcrumbs = $breadcrumbs;
        $this->render('view', $params);
    }
       
    public function actionEdit($parameters = [])
    {
      $establishmentId = $parameters[0];
      $establishment = new Establishment($establishmentId);

      if (isset($_POST['action'])) {
        if (strlen($_POST['establishment_name']) <= 2) {
          $this->messages['danger'][] = "Establishment Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $establishment->initObjectFromArray($_POST);
          if ($establishment->update()) {
            $_SESSION["flash"]["success"][] = "Establishment successfully updated";
          } else {
            $_SESSION["flash"]["danger"][] = "Establishment was not updated. Something goes wrong";
          }
          header("Location: /establishment/{$establishment->establishmentId}");
        }
      }
      $action = "edit";
      $params['establishment'] = $establishment;
      $params['action'] = "edit";
      $params['path'] = "edit/$establishmentId";
      $this->render('form', $params);
    }

    public function actionAdd($parameters = [])
    {

      $establishment = new Establishment();

      if (isset($_POST['action'])) {
        if (strlen($_POST['establishment_name']) <= 2) {
          $this->messages['danger'][] = "Establishment Name must have more than 2 chars";
        }
        if (empty($this->messages['danger'])) {
          $establishment->initObjectFromArray($_POST);
          if ($establishment->create()) {
            $_SESSION["flash"]["success"][] = "Establishment successfully created";
          } else {
            $_SESSION["flash"]["danger"][] = "Establishment was not created. Something goes wrong";
          }
          header("Location: /establishment/{$establishment->establishmentId}");
        }
      }
      $params['establishment'] = $establishment;
      $params['action'] = "add";
      $params['path'] = "add";
      $this->render('form', $params);
    }    
    
}