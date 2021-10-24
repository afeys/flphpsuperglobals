<?php
namespace FL;

class FrontEnd {
    public static function getFieldValue($fieldname, $default = "") {
        if (isset($_REQUEST[$fieldname])) {
            if (!is_array($_REQUEST[$fieldname])) {
                return urldecode($_REQUEST[$fieldname]);
            } else {
                return $_REQUEST[$fieldname];
            }
        } else {
            return $default;
        }
    }

    public static function setFieldValue($fieldname, $value) {
        $_REQUEST[$fieldname] = $value;
    }

    public static function clearFieldValue($fieldname) {
        if (isset($_REQUEST[$fieldname])) {
            unset($_REQUEST[$fieldname]);
        }
    }

    public static function isSetFieldValue($fieldname) {
        return isset($_REQUEST[$fieldname]);
    }
}
