<?php

namespace FL;

class Session {
    public static function setSessionVariable($variable, $value) {
        $_SESSION[$variable] = $value;
    }

    public static function clearSessionVariable($variable) {
        if (isset($_SESSION[$variable])) {
            unset($_SESSION[$variable]);
        }
    }

    public static function getSessionVariable($variable) {
        if (isset($_SESSION[$variable])) {
            return $_SESSION[$variable];
        } else {
            return "";
        }
    }

    public static function isSetSessionVariable($variable) {
        return isset($_SESSION[$variable]);
    }
}
