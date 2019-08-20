<?php
    require_once 'autoload.php';
    require '../vendor/autoload.php';

    $visma = new VismaAuth();
//    print_r( $visma->get_auth_url());
    $guzz_ctrl = new GuzzleController();
    $res = $guzz_ctrl->send_request($visma->get_auth_url(), 'GET');
    print_r($res);
    //    print_r($visma->get_params());