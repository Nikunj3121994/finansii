<?php

Event::listen('auth.token.created', function($user, $token)
{
    Session::put('token',$token['public_key']);
    Log::info('The token created event is fired.');
    return array("msg"=>"event fired");
});