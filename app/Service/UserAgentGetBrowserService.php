<?php


namespace App\Service;


class UserAgentGetBrowserService implements UserAgentInterface
{

    public $data;

    public function parse(string $userAgent)
    {
        $this->data = get_browser($userAgent, true);

    }

    public function clientBrowser()
    {
        return $this->data['browser'];
    }

    public function clientOs()
    {
        return $this->data['platform'];
    }
}
