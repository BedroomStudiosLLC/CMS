<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/CMS/HelperClasses/BootstrapAlertType.php');

    class HTMLAlerts
    {

        public static function GetHTMLAlert($message, $alertType){
            return '<div class="'.$alertType.'" role="alert">' . $message . '</div>';
        }

        public static function GetHTMLAlertWCloseButton($message, $alertType){
            return '<div class="'.$alertType.'" role="alert">' . $message . '</div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }

        public static function GetHTMLAlertWHeader($headerMessage, $message, $alertType){
            return '<div class="' . $alertType . '" role="alert"><h4 class="alert-heading">' . $headerMessage . '</h4><hr><p>' . $message . '</p></div>';
        }

        public static function GetHTMLAlertWHeaderAndCloseButton($headerMessage, $message, $alertType){
            return '<div class="' . $alertType . '" role="alert"><h4 class="alert-heading">' . $headerMessage . '</h4><hr><p>' . $message . '</p></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }
