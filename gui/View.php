<?php

namespace gui;
include_once "Layout.php";

/**
 *
 */
abstract class View
{
    /**
     * @var string
     */
    protected $title = '';
    /**
     * @var string
     */
    protected $content = '';
    /**
     * @var
     */
    protected $layout;

    /**
     * @param $layout
     */
    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return void
     */
    public function display()
    {
        $this->layout->display( $this->title, $this->content );
    }
}