<?php

/**
 * Common class.
 * Common is the data structure for keeping
 */
class Csvjson extends CFormModel
{
    public static function getHeaderRow($row, $header)
    {
        foreach ($row as $index => $value) {
            $text = strtolower($value);
            $text = trim($text);
            $text = preg_replace('!\s+!', '_', $text);
            $header[ $index ] = strtolower($text);
        }

        return $header;
    }

    public static function explodeComma($value)
    {
        $array = explode(',', $value);
        return $array;
    }


    public static function validate_name($row_error, $field, $value)
    {
        if ($field == 'first_name' && !$value) {
            $row_error[ $field ] = $value;
            $row_error[ $field . '_error' ] = 'First Name must be non-empty string';
        }

        if ($field == 'last_name' && !$value) {
            $row_error[ $field ] = $value;
            $row_error[ $field . '_error' ] = 'Last Name must be non-empty string';
        }

        return $row_error;
    }

    public static function validate_password($row_error, $field, $value)
    {
        if (($field == 'password') && strlen($field) < 8) {
            $row_error[ $field ] = $value;
            $row_error[ $field . '_error' ] = 'Password must be minimum 8 characters';
        }

        return $row_error;
    }

    public static function validate_email($row_error, $field, $value)
    {
        if (($field == 'email') && (!preg_match(
                "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $value))
        ) {
            $row_error[ $field ] = $value;
            $row_error[ $field . '_error' ] = 'Email must be in user@domain.com format';

        }

        return $row_error;
    }

    public static function validate_platform($row_error, $field, $value)
    {
        if (($field == 'platforms')) {

            $platform_data = self::explodeComma($value);

            $valid = in_array('ios', $platform_data)
                || in_array('windows', $platform_data)
                || in_array('android', $platform_data)
                || in_array('web', $platform_data);

            if (!$valid) {
                $row_error[ $field ] = $value;
                $row_error[ $field . '_error' ] = 'Platforms must be one of these ios, windows, android, web';
            }
        }

        return $row_error;
    }

    public static function getCsvJsonOutput($row_data, $field, $value)
    {

        $row_data[ $field ] = $value;

        if( ($field == 'platforms')){
            $platform_data = explode(',', $value);
            $row_data[ $field ] = $platform_data;
        }

        return $row_data;
    }

    public static function getCsvJsonError($row_error, $field, $value)
    {
        $row_error = self::validate_name($row_error, $field, $value);
        $row_error = self::validate_password($row_error, $field, $value);
        $row_error = self::validate_email($row_error, $field, $value);
        $row_error = self::validate_email($row_error, $field, $value);
        $row_error = self::validate_platform($row_error, $field, $value);

        return $row_error;
    }

}
