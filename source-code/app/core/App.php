<?php 
/**
 * Main app
 */
class App
{
    protected $router;
    protected $controller;
    // An array of the URL routes
    protected static $routes = [];


    /**
     * summary
     */
    public function __construct()
    {
        $this->controller = new Controller;
    }


    /**
     * Adds a new route to the App:$routes static variable
     * App::$routes will be mapped on a route 
     * initializes on App initializes
     * 
     * Format: ["METHOD", "/uri/", "Controller"]
     * Example: App:addRoute("GET|POST", "/post/?", "Post");
     */
    public static function addRoute()
    {
        $route = func_get_args();
        if ($route) {
            self::$routes[] = $route;
        }
    }


    /**
     * Get App::$routes
     * @return array An array of the added routes
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Check and get authorized user data
     * Define $AuthUser variable
     */
    private function auth()
    {
        $AuthUser = null;
        if(Input::cookie("accessToken")){
            $accessToken = Input::cookie("accessToken");
            if(!$accessToken)  return $AuthUser;

            $headers = [
                'Connection: close',
                'Authorization: JWT '.$accessToken,
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 Safari/537.36',
            ];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => APIURL."/profile",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $resp = @json_decode($response);
            if($resp->result == 1){
                $AuthUser = new Auth();
                foreach ($resp->data as $field => $value){
                    $AuthUser->set($field, $value);
                }
                $AuthUser->set("accessToken", $accessToken);
                $AuthUser->markAsAvailable();

                if (Input::cookie("mplrmm")) {
                    setcookie("accessToken", $accessToken, time()+86400*30, "/", DOMAINNAME);
                    setcookie("mplrmm", "1", time()+86400*30, "/", DOMAINNAME);
                }
            }

            // try {
            //     $client = new GuzzleHttp\Client($headers);
            //     $resp = $client->request('GET', APIURL."/profile");
            //     $resp = @json_decode($resp->getBody());
            //     if($resp->result == 1){
            //         $AuthUser = new Auth();
            //         foreach ($resp->data as $field => $value){
            //             $AuthUser->set($field, $value);
            //         }
            //         $AuthUser->set("accessToken", $accessToken);
            //         $AuthUser->markAsAvailable();

            //         if (Input::cookie("mplrmm")) {
            //             setcookie("accessToken", $accessToken, time()+86400*30, "/", DOMAINNAME);
            //             setcookie("mplrmm", "1", time()+86400*30, "/", DOMAINNAME);
            //         }
            //     }
            // } catch (\Exception $e) {
                
            // }
        }
        return $AuthUser;
    }

    private function settings($name = "site")
    {
        $Settings = new Settings();

         if($name == "smtp"){
            $accessToken =  Input::cookie("accessToken");
            if(!$accessToken)  return $Settings;
    
            $headers = [
                'Connection: close',
                'Authorization: JWT '.$accessToken,
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 Safari/537.36',
            ];
        }else{
            $headers = [];
        }

        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => APIURL."/settings/".$name,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $resp = @json_decode($response);
        if($resp->result == 1){
            foreach ($resp->data as $field => $value){
                $Settings->set($field, $value);
            }
            $Settings->markAsAvailable();
        }

        // if($name == "smtp"){
        //     $accessToken =  Input::cookie("accessToken");
        //     if(!$accessToken)  return $Settings;
    
        //     $headers = [
        //         'headers' => [
        //             'Connection' => 'close',
        //             'Authorization' => 'JWT '.$accessToken,
        //             'User-Agent'    => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 Safari/537.36',
        //         ]
        //     ];
        //     $client = new GuzzleHttp\Client($headers);
        // }else{
        //     $client = new GuzzleHttp\Client();
        // }
        
        // try {
        //     $resp = $client->request('GET', APIURL."/settings/".$name);
        //     $resp = @json_decode($resp->getBody());
        //     if($resp->result == 1){
        //         foreach ($resp->data as $field => $value){
        //             $Settings->set($field, $value);
        //         }
        //         $Settings->markAsAvailable();
        //     }
        // } catch (\Exception $e) {
        //     // print_r($e->getMessage());
        // }
        return $Settings;
    }


    /**
     * Define ACTIVE_LANG constant
     * Include languge strings
     */
    private function i18n()
    {   
        $Route = $this->controller->getVariable("Route");
        $Settings = $this->controller->getVariable("Settings");

        if($Settings){
            $lang = $Settings->get("language");
        } else if (isset($Route->params->lang)) {
            // Direct link or language change
            // Getting lang from route
            $lang = $Route->params->lang;
        } else if (Input::cookie("lang")) {
            // Returninn user (non-auth),
            // Getting lang. from the cookie
            $lang = Input::cookie("lang");
        } else {
            // New user
            $lang = Config::get("default_applang");
        }


        // Validate found language code
        $active_lang = Config::get("default_applang");
        foreach (Config::get("applangs") as $al) {
            if ($al["code"] == $lang || $al["shortcode"] == $lang) {
                // found, break loop
                $active_lang = $al["code"];
                break;
            }
        }

        define("ACTIVE_LANG", $active_lang);
        @setcookie("lang", ACTIVE_LANG, time()+30 * 86400, "/");


        $Translator = new Gettext\Translator;

        // Load app. locale
        $path = APPPATH . "/locale/" . ACTIVE_LANG . "/messages.po";
        if (file_exists($path)) {
            $translations = Gettext\Translations::fromPoFile($path);
            $Translator->loadTranslations($translations);
        }

        $Translator->register(); // Register global functions

        // Set other library locales
        try {
            \Moment\Moment::setLocale(str_replace("-", "_", ACTIVE_LANG));
        } catch (Exception $e) {
            // Couldn't load locale
            // There is nothing to do here,
            // Fallback to default language
        }
    }


    /**
     * Analize route and load proper controller
     * @return App
     */
    private function route()
    {
        // Initialize the router
        $router = new AltoRouter();
        $router->setBasePath(BASEPATH);

        // Load plugin/theme routes first
        // TODO: Update router.map in modules to App::addRoute();
        $GLOBALS["_ROUTER_"] = $router;
        \Event::trigger("router.map", "_ROUTER_");
        $router = $GLOBALS["_ROUTER_"];

        // Load global routes
        include APPPATH."/inc/routes.inc.php";
        
        // Map the routes
        $router->addRoutes(App::getRoutes());

        // Match the route
        $route = $router->match();
        $route = json_decode(json_encode($route));

        if ($route) {
            if (is_array($route->target)) {
                require_once $route->target[0];
                $controller = $route->target[1];
            } else {
                $controller = $route->target."Controller";
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            $controller = "IndexController";
        }

        $this->controller = new $controller;
        $this->controller->setVariable("Route", $route);
    }


    /**
     * Process
     */
    public function process()
    {
        /**
         * Auth.
         */
        $AuthUser = $this->auth();

        /**
         * Settings.
         */
        $Settings = $this->settings("site");
        /**
         * SMTP.
         */
        $SMTP = $this->settings("smtp");
        

        /**
         * Analize the route
         */
        $this->route();
        $this->controller->setVariable("AuthUser", $AuthUser);
        $this->controller->setVariable("Settings", $Settings);
        $this->controller->setVariable("SMTP", $SMTP);


        /**
         * Init. locales
         */
        $this->i18n();


        $this->controller->process();
    }
}