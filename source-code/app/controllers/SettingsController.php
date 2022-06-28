<?php
/**
 * Settings Controller
 */
class SettingsController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");

        if (!$AuthUser || !$AuthUser->isAdmin()){
            header("Location: ".APPURL."/login");
            exit;
        } 
        $this->view("settings");
    }
}