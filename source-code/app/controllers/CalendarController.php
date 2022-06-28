<?php
/**
 * Calendar Controller
 */
class CalendarController extends Controller
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
        $this->view("calendar");
    }
}