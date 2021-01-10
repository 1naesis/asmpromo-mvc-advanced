<?php
use Component\Controller;
/**
 * Контроллер SiteController
 */
class SiteController extends Controller
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require_once($this->app . '/views/site/index.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionAbout()
    {
        require_once($this->app . '/views/site/about.php');
        return true;
    }


}
