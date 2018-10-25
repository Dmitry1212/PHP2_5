<?php
class Rectangle{
    protected $height;
    protected $width;

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

}

class Square extends Rectangle{
    public function setHeight($height)
    {
        parent::setHeight($height);
        $this->width = $height;
    }

    public function setWidth($width)
    {
        parent::setWidth($width);
        $this->height = $width;
    }

}

function calculateArea(Rectangle $object){
    return $object->getHeight() * $object->getWidth();
}

$figure = new Square();
$figure->setHeight(4);
$figure->setWidth(5);

var_dump(calculateArea($figure));



