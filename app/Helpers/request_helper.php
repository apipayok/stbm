<?php

if (!function_exists('Post')) {
    function Post($key = null, $default = null)
    {
        $request = \Config\Services::request();
        return $key ? $request->getPost($key) ?? $default : $request->getPost();
    }
}

if (!function_exists('Get')) {
    function Get($key = null, $default = null)
    {
        $request = \Config\Services::request();
        return $key ? $request->getGet($key) ?? $default : $request->getGet();
    }
}
