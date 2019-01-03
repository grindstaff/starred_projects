<?php

namespace App\Service;

class ExternalRequest
{    
    public function performRequest(string $siteUrl)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $siteUrl);
        curl_setopt($ch, CURLOPT_USERAGENT, "grindstaff");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($ch);
    }
}