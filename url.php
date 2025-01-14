<?php
final class URL
{
    static function relative2Absolute($sourceUrl, $requestUrl = null): string
    {
        preg_match('/^https?:\/\/[^#?]*/', $sourceUrl, $sourceUrl);
        $sourceUrl = $sourceUrl[0];
        preg_match('/^https?:\/\/[^\/]*/', $sourceUrl, $rootUrl);
        $rootUrl = $rootUrl[0];

        if (str_starts_with($requestUrl, $sourceUrl))
            return $requestUrl;
        else if (preg_match('/^https?:\/\//', $requestUrl))
        {
            preg_match('/^https?:\/\/[^#?]*/', $requestUrl, $requestUrl);
            return $requestUrl[0];
        }
        else if (preg_match('/^\/\//', $requestUrl))
            return "https:$requestUrl";
        else if (preg_match('/^\//', $requestUrl))
            return "$rootUrl$requestUrl";
        else
            return "$sourceUrl/$requestUrl";
    }
}