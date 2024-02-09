<?php

namespace gui;

/**
 *
 */
class Layout
{
    /**
     * @var
     */
    protected $templateFile;

    /**
     * @param $templateFile
     */
    public function __construct($templateFile )
    {
        $this->templateFile = $templateFile;
    }

    /**
     * @param $title
     * @param $content
     * @return void
     */
    public function display($title, $content )
    {
        $page = file_get_contents( $this->templateFile );
        $page = str_replace( ['%title%','%content%'], [$title,$content], $page);
        echo $page;
    }

}