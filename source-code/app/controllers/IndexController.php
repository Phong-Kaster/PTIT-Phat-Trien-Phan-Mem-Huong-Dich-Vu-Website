<?php
/**
 * Index Controller
 */
class IndexController extends Controller
{
    /**
     * Process
     */
    public function process()
    {   
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser){
            // Auth
            header("Location: ".APPURL."/login");
            exit;
        }
        // Set variables
        $this->view("dashboard");
    }
}