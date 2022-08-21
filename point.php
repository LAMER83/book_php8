<?php
class Point
{
    private $x = 0;
    private $y = 0;

    public function setValue(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }
    public function getY(): int
    {
        return $this->y;
    }
}

$point = new Point();

$point->setValue('s', 's');