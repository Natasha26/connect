<?php
class GalleryController extends Controller
{
    /**
     * Generates Gallery List
     * Handles creating and updating requests
     * 06.07.2017 by AlexKuzmenko
     */    
    public function actionList($parameters = [])
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                if ($_POST['action'] == 'add_gallery') {
                    $gallery = new Gallery();
                    $gallery->gallery_name = $_POST['gallery_name'];
                    $gallery->gallery_description = $_POST['gallery_description'];
                    if ($gallery->create()) {
                        $this->log['message'][] = "Нову галерею додано";
                    }
                } elseif ($_POST['action'] == 'delete_galleries') {
                    if (!empty($_POST['gallery'])) {
                        foreach ($_POST['gallery'] as $galleryID){
                            $gallery = new Gallery($galleryID);
                            $gallery->delete();
                        }
                        $this->log['message'][] = "Галереї успішно видалено";
                    }
                }
            } catch (Exception $e) {
                $this->log['error'][] = $e->getMessage();
            }
        } 
        $params['galleries'] = Gallery::getGalleries();
        $this->render('list', $params);
    }
    
    /**
     * Generates a Form for editing a Gallery
     * Handles Deleting Images or Updating a Gallery
     * Modified 07.07.2017 by AlexKuzmenko
     */
    public function actionEdit($parameters = [])
    {
        $gallery_id = $parameters[0];
        $gallery = new Gallery($gallery_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                if ($_POST["action"] == "delete_images") {
                    if ($gallery->deleteImages($_POST["image"])) {
                        $this->log['message'][]="Зображення успішно видалені.";
                    } else {
                        $this->log['error'][] = "Неможливо видалити зображення";
                    }
                } else if($_POST["action"] == "edit_gallery"){
                    $gallery->gallery_name = $_POST["gallery_name"];
                    $gallery->gallery_description = $_POST["gallery_description"];
                    $gallery->update();
                }
            } catch (Exception $e) {
                $this->log['error'][] = $e->getMessage();
            }
        }
        
        $gallery->getInfoById($gallery_id);
        $gallery->getImages();
        $params["gallery"] = $gallery;
        $this->render('edit', $params);
    }

    public function actionAdd($parameters = [])
    {
        $this->render('add');
    }    
    
    /**
     * Saves Image Title
     * AJAX
     * 06.07.2017 by AlexKuzmenko
     */
    public function actionImageTitleSave($parameters = [])
    {
        $imageID = $_POST['image_id'];
        $imageTitle = $_POST['title'];
        $result = Gallery::saveImageTitle($imageID, $imageTitle);
        if ($result) {
            echo $imageTitle;
        }
        die;
    } 
}