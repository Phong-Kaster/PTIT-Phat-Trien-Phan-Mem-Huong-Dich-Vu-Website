<?php 
class TransactionController extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser){
            // Auth
            header("Location: ".APPURL."/login");
            exit;
        }
        $this->view("transaction");
    }
}
