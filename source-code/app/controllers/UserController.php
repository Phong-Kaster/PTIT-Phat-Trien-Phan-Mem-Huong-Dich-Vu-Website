<?php
/**
 * User Controller
 */
class UserController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");

        // Auth
        if (!$AuthUser){
            header("Location: ".APPURL."/login");
            exit;
        } else if (!$AuthUser->isAdmin()) {
            header("Location: ".APPURL."/dashboard");
            exit;
        }


        $this->view("user");
    }
}