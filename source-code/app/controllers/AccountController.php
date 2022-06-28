<?php
/**
 * Account Controller
 */
class AccountController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route");
        if (!$AuthUser){
            // Auth
            header("Location: ".APPURL."/login");
            exit;
        }

        $accountid = isset($Route->params->id) ? $Route->params->id : "0";
        $this->setVariable("accountid", $accountid);

        $this->view("account");
    }
}