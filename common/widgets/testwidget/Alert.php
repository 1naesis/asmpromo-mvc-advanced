<?php

namespace Widgets\testwidget;

use Component\Widgets;

/**
 * Class Alert
 * @package Widgets\testwidget
 *
 * Вызов виджета \Widgets\testwidget\Alert::widget(['param' => $param])
 */
class Alert extends Widgets
{
    public $param;
    public $text;

    public function run()
    {
        return $this->render('index', [
            'param' => $this->param,
            'text' => $this->text
        ]);
    }
}