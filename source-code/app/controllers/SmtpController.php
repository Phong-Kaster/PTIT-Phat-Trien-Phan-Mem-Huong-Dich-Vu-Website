<?php
/**
 * Smtp Controller
 */
class SmtpController extends Controller
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
        $this->view("smtp");
    }
}