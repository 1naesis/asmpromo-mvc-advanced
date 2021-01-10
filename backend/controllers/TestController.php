<?php
use Component\Controller;
/**
 * Контроллер SiteController
 */
class TestController extends Controller
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        require_once($this->app . '/views/test/index.php');
        return true;
    }

    /**
     * Action для страницы "О компании"
     */
    public function actionAbout()
    {
        require_once($this->app . '/views/test/about.php');
        return true;
    }


}
