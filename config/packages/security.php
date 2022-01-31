<?php
// config/packages/security.php
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security) {
    // ...

    $mainFirewall = $security->firewall('main');
    $mainFirewall->jsonLogin()
        ->checkPath('api_login')
    ;
};