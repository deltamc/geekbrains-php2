<?php

/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 23.08.2017
 * Time: 11:54
 */
class GalleryController
{
    private $twig;
    private $model;


    public function __construct(PDO $db, Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->model = new GalleryModel($db);

    }

    public function viewAllAction(array $param)
    {
        $galleryData = $this->model->getAllObjects();
        $template = $this->twig->loadTemplate('all.tmpl');

        return $template->render(array (
            'galleryData' => $galleryData,
            'imgDir'      => IMAGES_DIR
        ));
    }

    public function viewOneAction(array $param)
    {
        if (!isset($param['id'])) {
            throw new Exception('404 Images no found');
        }

        $id = (int) $param['id'];

        $galleryData = $this->model->getOneObjects($id);

        if (empty($galleryData)) {
            throw new Exception('404 Images no found');
        }

        $template = $this->twig->loadTemplate('one.tmpl');

        return $template->render(array (
            'galleryData' => $galleryData,
            'imgDir'      => IMAGES_DIR
        ));
    }
}