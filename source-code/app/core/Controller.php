<?php
/**
 * Controller
 */
class Controller
{   
    /**
     * Assosiative array
     * Key: will be converted to variable for view
     * Value: value of the variable with name Key
     * @var array
     */
    protected $variables;

    /**
     * JSON output response holder
     * @var \stdClass
     */
    protected $resp;

    /**
     * Initialize variables
     * @param array $variables  [description]
     */
    public function __construct($variables = array())
    {
        $this->variables = array();
        $this->resp = new stdClass;
    }

    /**
     * View
     * @param  string $view name of view file
     * @param  string $context 
     * @return void       
     */
    public function view($view, $context = "app")
    {
        foreach ($this->variables as $key => $value) {
            ${$key} = $value;
        }

        switch ($context) {
            case "app":
                $path = APPPATH."/views/".$view.".php";
                break;

            case "site":
                $path = active_theme("path") . "/views/" . $view .".php";
                break;

            default: 
                $path = $view;
        }


        require_once $path;
    }


    /**
     * Set new variable for view.
     * @param string $name  Name of the variable.
     * @param mixed $value 
     */
    public function setVariable($name, $value)
    {
        $this->variables[$name] = $value;
        return $this;
    }


    /**
     * Get variable
     * @param  string $name Name of the varaible.
     * @return mixed       
     */
    public function getVariable($name)
    {
        return isset($this->variables[$name]) ? $this->variables[$name] : null;
    }


    /**
     * Print json(or jsonp) string and exit;
     * @return void 
     */
    protected function jsonecho($resp = null)
    {
        if (is_null($resp)) {
            $resp = $this->resp;
        }
        
        echo Input::get("callback") ? 
                Input::get("callback")."(".json_encode($resp).")" : 
                    json_encode($resp);
        exit;
    }
}
