<?php
/**
 * Login Controller
 */
class LoginController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        if ($AuthUser) {
            header("Location: ".APPURL);
            exit;
        }
        
        if (Input::post("action") == "login") {
            $this->login();
        } 
        $this->view("login");
    }


    /**
     * Login
     * @return void
     */
    private function login()
    {
        $username = Input::post("username");
        $password = Input::post("password");
        $remember = Input::post("remember");

        if ($username && $password) {
            try {
                $client = new GuzzleHttp\Client();
                $resp = $client->request('POST', APIURL."/login",  [
                    'form_params' => [
                        'username' => $username,
                        'password' => $password
                    ]
                ]);
                $resp = @json_decode($resp->getBody());
                if($resp->result == 1){
                    
                    
                    $exp = $remember ? time()+86400*30 : 0;
                    setcookie("accessToken", $resp->accessToken, $exp, "/", DOMAINNAME);
                    if($remember) {
                        setcookie("mplrmm", "1", $exp, "/", DOMAINNAME);
                    } else {
                        setcookie("mplrmm", "1", time() - 30*86400, "/", DOMAINNAME);
                    }
    
                    // Fire user.signin event
                    // Event::trigger("user.signin", $User);
    
                    header("Location: ".APPURL);
                    exit;
                }
            } catch (\Exception $e) {
                
            }
        }

        return $this;
    }
}