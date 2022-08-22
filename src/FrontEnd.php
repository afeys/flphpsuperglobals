<?php

namespace FL;

class FrontEnd {

    public static function getFieldValue(string $fieldname, string $default = null): string {
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

    public static function setFieldValue(string $fieldname, string $value): void {
        $_REQUEST[$fieldname] = $value;
    }

    public static function clearFieldValue(string $fieldname): void {
        if (isset($_REQUEST[$fieldname])) {
            unset($_REQUEST[$fieldname]);
        }
    }

    public static function isSetFieldValue(string $fieldname): bool {
        return isset($_REQUEST[$fieldname]);
    }

    public static function htmlComment($comment) {
        return "<!-- " . $comment . " -->";
    }
    
    public static function getPostGetDataAsString() {
        $postgetdata = '$_GET:';
        foreach ($_GET as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    $postgetdata .= "[" . $k2 . "]=(" . $v2 . ");";
                }
            } else {
                $postgetdata .= "[" . $k . "]=(" . $v . ");";
            }
        }
        $postgetdata .= "_POST:";
        foreach ($_POST as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    $postgetdata .= "[" . $k2 . "]=(" . $v2 . ");";
                }
            } else {
                $postgetdata .= "[" . $k . "]=(" . $v . ");";
            }
        }
        return $postgetdata;
    }

}
