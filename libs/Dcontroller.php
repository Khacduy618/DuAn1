<?php
abstract class Dcontroller{
    public $load;
    
    public function __construct()
    {
        $this->load = new Load();
    }
    abstract public function render(string $nameView, array $model);

    
}

?>