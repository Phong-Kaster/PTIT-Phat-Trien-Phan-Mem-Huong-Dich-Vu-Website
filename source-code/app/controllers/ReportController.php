<?php
/**
 * Income Controller
 */
class ReportController extends Controller
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

        $page = isset( $Route->params->page ) ?  $Route->params->page : "income";

        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "income" )
        {
            $this->view("reportincome");
        }
        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "expense" )
        {
            $this->view("reportexpense");
        }
        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "incomevsexpense" )
        {
            $this->view("reportincomevsexpense");
        }
        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "incomemonth" )
        {
            $this->view("reportincomemonthly");
        }
        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "expensemonth" )
        {
            $this->view("reportexpensemonthly");
        }
        if( $_SERVER["REQUEST_METHOD"] === 'GET' && $page == "transactions" )
        {
            $this->view("reporttransactions");
        }
    }
}

?>