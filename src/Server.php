<?php
namespace FL;

class Server {

    public static function getServerVariable(string $variable): string {
        return $_SERVER[$variable];
    }

    public static function getServerName(): string {
        return Server::getServerVariable('SERVER_NAME');
    }

    public static function getServerAddress(): string {
        return Server::getServerVariable('SERVER_ADDR');
    }

}
