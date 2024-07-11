<?php

class EditModal
{
    private $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function render()
    {
        if (isset($this->student) && !empty($this->student)) {
            $student = $this->student;
            include 'element.php';
        }
    }
}
