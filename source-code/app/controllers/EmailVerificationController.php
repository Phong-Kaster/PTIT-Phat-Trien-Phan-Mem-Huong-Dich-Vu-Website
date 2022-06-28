<?php
/**
 * EmailVerification Controller
 */
class EmailVerificationController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $Route = $this->getVariable("Route");
        $AuthUser = $this->getVariable("AuthUser");

        $id = $Route->params->id;
        $hash = $Route->params->hash;

        $User = \Controller::model("User", $id);

        if (!$User->isAvailable()) {
            header("Location: ".APPURL);
            exit;
        }

        if ($AuthUser && $AuthUser->isAvailable() && $User->get("id") != $AuthUser->get("id")) {   
            // This mail verification is not for authorized user
            // Logout currently authorized user
            setcookie("nplh", null, time()-86400*365, "/");
            setcookie("nplrmm", null, time()-86400*365, "/");

            $AuthUser = false;

            // Fire user.signout event
            Event::trigger("user.signout", $AuthUser);
        }

        $data = json_decode($User->get("data"));
        if (!isset($data->email_verification_hash)) {
            // Invalid data
            header("Location: ".APPURL."/login");
            exit;
        }

        if ($hash != $data->email_verification_hash) {
            // Invalid hash
            header("Location: ".APPURL);
            exit;
        }

        $User->setEmailAsVerified();
        $this->view("email-verification");
    }
}