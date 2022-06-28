<?php
/**
 * Users Controller
 */
class UsersController extends Controller
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
        }

        // Get Users
        // $Users = Controller::model("Users");
        //     $Users->search(Input::get("q"))
        //           ->setPageSize(10)
        //           ->setPage(Input::get("page"))
        //           ->orderBy("id","DESC")
        //           ->fetchData();

        // $this->setVariable("Users", $Users);

        $this->view("users");
    }
}