<?php

/**
 * Контроллер SiteController
 */
class TestController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require_once(APP . '/views/test/index.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionAbout()
    {
        require_once(APP . '/views/test/about.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionView($id)
    {
        $id = $id;
        require_once(APP . '/views/test/view.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionFind($id)
    {
        echo $id;
        echo "Нашел";
        return true;
    }

}
