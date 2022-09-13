<?php

namespace FL;

class Session {
    public static function setSessionVariable(string $variable, mixed $value): void {
        $_SESSION[$variable] = $value;
    }

    public static function clearSessionVariable(string $variable): void {
        if (isset($_SESSION[$variable])) {
            unset($_SESSION[$variable]);
        }
    }

    public static function getSessionVariable(string $variable): mixed {
        if (isset($_SESSION[$variable])) {
            return $_SESSION[$variable];
        } else {
            return "";
        }
    }

    public static function isSetSessionVariable(string $variable): bool {
        return isset($_SESSION[$variable]);
    }
    
    public static function clearAllSessionVariables() {
        $_SESSION = array();
    }
    
}
