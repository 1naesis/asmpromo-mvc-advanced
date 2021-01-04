<?php

/**
 * Контроллер SiteController
 */
class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionAbout()
    {
        require_once(ROOT . '/views/site/about.php');
        return true;
    }


}
