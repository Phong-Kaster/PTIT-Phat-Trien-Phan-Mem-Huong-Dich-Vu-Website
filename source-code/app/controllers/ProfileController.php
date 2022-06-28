<?php
/**
 * Profile Controller
 */
class ProfileController extends Controller
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
        
        if (Input::post("action") == "save") {
            $this->save();
        }else if (Input::post("action") == "change") {
            $this->changePass();
        }

        $this->view("profile");
    }



    /**
     * Save changes
     * @return void 
     */
    private function save()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");

        // Check required fields
        $required_fields = ["firstname", "lastname"];

        foreach ($required_fields as $field) {
            if (!Input::post($field)) {
                $this->resp->msg = __("Missing some of required data.");
                $this->jsonecho();
            }
        }

        try {
            $client = new GuzzleHttp\Client([
                'headers' => [
                    'Authorization' => 'JWT '.$AuthUser->get("accessToken"),
                ]
            ]);
            $resp = $client->request('POST', APIURL."/profile",  [
                'form_params' => [
                    'firstname' => Input::post("firstname"),
                    'lastname' => Input::post("lastname"),
                    'action' => 'save'
                ]
            ]);
            $resp = @json_decode($resp->getBody());
            if($resp->result == 0){
                $this->resp->msg = $resp->msg;
                $this->jsonecho();
            }
        } catch (\Exception $e) {
            $this->resp->msg = $e->getMessage();
            $this->jsonecho();
        }

        $this->resp->result = 1;
        $this->resp->msg = __("Changes saved!");
        
        $this->jsonecho();
    }


    private function changePass()
    {
        $this->resp->result = 0;
        $AuthUser = $this->getVariable("AuthUser");


        // Check required fields
        $required_fields = ["password", "password-confirm"];

        foreach ($required_fields as $field) {
            if (!Input::post($field)) {
                $this->resp->msg = __("Missing some of required data.");
                $this->jsonecho();
            }
        }

        try {
            $client = new GuzzleHttp\Client([
                'headers' => [
                    'Authorization' => 'JWT '.$AuthUser->get("accessToken"),
                ]
            ]);
            $resp = $client->request('POST', APIURL."/change-password",  [
                'form_params' => [
                    'password' => Input::post("password"),
                    'password-confirm' => Input::post("password-confirm"),
                ]
            ]);
            $resp = @json_decode($resp->getBody());
            if($resp->result == 0){
                $this->resp->msg = $resp->msg;
                $this->jsonecho();
            }
            setcookie("accessToken", $resp->accessToken, time()+86400*30, "/", DOMAINNAME);
        } catch (\Exception $e) {
            $this->resp->msg = $e->getMessage();
            $this->jsonecho();
        }

        $this->resp->result = 1;
        $this->resp->msg = __("Changes saved!");
        
        $this->jsonecho();
    }
}