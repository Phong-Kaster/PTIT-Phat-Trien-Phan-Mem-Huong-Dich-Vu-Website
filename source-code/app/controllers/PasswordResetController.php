<?php
/**
 * Password Reset Controller
 */
class PasswordResetController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");

        if ($AuthUser) {
            header("Location: ".APPURL."/dashboard");
            exit;
        }

        $this->view("password-reset");
    }
}