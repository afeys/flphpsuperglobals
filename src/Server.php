<?php
namespace FL;

class Server {

    public static function getServerVariable($variable) {
        return $_SERVER[$variable];
    }

    public static function getServerName() {
        return Server::getServerVariable('SERVER_NAME');
    }

    public static function getServerAddress() {
        return Server::getServerVariable('SERVER_ADDR');
    }

}
