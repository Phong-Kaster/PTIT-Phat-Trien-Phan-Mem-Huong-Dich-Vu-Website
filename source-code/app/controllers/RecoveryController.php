<?php
/**
 * Recovery Controller
 */
class RecoveryController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if ($AuthUser) {
            header("Location: ".APPURL."/dashboard");
            exit;
        }
        $this->view("recovery");
    }
}