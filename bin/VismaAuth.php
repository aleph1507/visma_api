<?php
    class VismaAuth {
        private $registry;
        private $auth_url;

        public function __construct()
        {
            $this->registry = Registry::get_instance();
            $this->set_auth_params();
            $this->set_auth_url();
        }

        private $scopes = ['ea:api', 'ea:sales', 'ea:purchase', 'ea:accounting', 'offline_access'];
        private $params = [];
//        private $url = '?client_id=<client_id>&redirect_uri=<redirect_uri>&scope=ea:api%20offline_access%20ea:sales&state=tenshinkandojo&response_type=code&prompt=login&acr_values=service:44643EB1-3F76-4C1C-A672-402AE8085934+forceselectcompany:true';
        private function set_auth_params()
        {
            $this->params = [
                'client_id' => $this->registry::getClientId(),
                'redirect_uri' => $this->registry::getRedirectUri(),
                'scope' => implode('%20', $this->scopes),
                'state' => 'teshinkandojo',
                'response_type' => 'code',
                'prompt' => 'login'
            ];
        }

        private function set_auth_url() {
            $this->auth_url = $this->registry::getAuthUrl() . '?';
            foreach($this->params as $key => $value)
            {
                $this->auth_url .= $key . '=' . $value . '&';
            }

//            $params_string = implode(' ', $this->scopes);
//            $this->auth_url = $this->registry::getAuthUrl() . '/' . http_build_query($this->params);
        }

        public function get_auth_url() {
            return $this->auth_url;
        }

        public function get_params(){
            return $this->params;
        }

    }