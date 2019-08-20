<?php
    class Registry {
        private static $instance;
        private static $auth_url;
        private static $token_url;
        private static $eAccounting_client;
        private static $eAccounting_api;
        private static $client_id;
        private static $client_secret;
        private static $redirect_uri;

        private static $sandbox = [
            'Visma_eAccounting_Client' => 'https://eaccounting-sandbox.test.vismaonline.com',
            'Visma_eAccounting_API' => 'https://eaccountingapi-sandbox.test.vismaonline.com/v2',
            'Visma_IdentityServer_Authorization' => 'https://identity-sandbox.test.vismaonline.com/connect/authorize',
            'Visma_IdentityServer_Token' => 'https://identity-sandbox.test.vismaonline.com/connect/token'
        ];

        private static $production = [
            'Visma_eAccounting_Client' => 'https://eaccounting.vismaonline.com',
            'Visma_eAccounting_API' => 'https://eaccountingapi.vismaonline.com/v2',
            'Visma_IdentityServer_Authorization' => 'https://identity.vismaonline.com/connect/authorize',
            'Visma_IdentityServer_Token' => 'https://identity.vismaonline.com/connect/token'
        ];

        private function __construct($mode)
        {
            if(!self::$instance)
            {
                if(!file_exists('../visma.ini'))
                {
                    echo json_encode(['error' => 'visma.ini file not found']);
                    die();
                }
                if(!$conf = parse_ini_file('../visma.ini'))
                {
                    echo json_encode(['error' => 'cannot parse visma.ini']);
                }
                self::$auth_url = self::$$mode['Visma_IdentityServer_Authorization'];
                self::$token_url = self::$$mode['Visma_IdentityServer_Token'];
                self::$eAccounting_client = self::$$mode['Visma_eAccounting_Client'];
                self::$eAccounting_api = self::$$mode['Visma_eAccounting_API'];
                self::$client_id = $conf['client_id'];
                self::$client_secret = $conf['client_secret'];
                self::$redirect_uri = $conf['redirect_uri'];
            }
        }

        public static function get_instance($mode = 'sandbox')
        {
            if (!self::$instance)
            {
                self::$instance = new Registry($mode);
            }

            return self::$instance;
        }

        /**
         * @return mixed
         */
        public static function getAuthUrl()
        {
            return self::$auth_url;
        }

        /**
         * @return mixed
         */
        public static function getTokenUrl()
        {
            return self::$token_url;
        }

        /**
         * @return mixed
         */
        public static function getEAccountingClient()
        {
            return self::$eAccounting_client;
        }

        /**
         * @return mixed
         */
        public static function getEAccountingApi()
        {
            return self::$eAccounting_api;
        }

        /**
         * @return mixed
         */
        public static function getClientId()
        {
            return self::$client_id;
        }

        /**
         * @return mixed
         */
        public static function getClientSecret()
        {
            return self::$client_secret;
        }

        /**
         * @return mixed
         */
        public static function getRedirectUri()
        {
            return self::$redirect_uri;
        }
    }