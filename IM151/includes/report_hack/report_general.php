<?php

class report_general extends report_module
{
    var $mode = 'report';
    var $duplicates = true;
 
    // Declare properties explicitly
    public $id;
    public $data;
    public $lang;
 
    //
    // Constructor
    //
    function __construct($id, $data, $lang)
    {
        $this->id = $id;
        $this->data = $data;
        $this->lang = $lang;
    }
}

?>
