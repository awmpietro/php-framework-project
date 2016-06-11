<?php
namespace Lib;
include \Autoloader::generalLoader('gump.class.php');
use \Gump as Gump;

class FormValidation extends GUMP {

	/**
     * @overload GUMP::get_readable_errors      
     */
    public function get_readable_errors($convert_to_string = false, $field_class = 'gump-field', $error_class = 'gump-error-message')
    {
        if (empty($this->errors)) {
            return ($convert_to_string) ? null : array();
        }

        $resp = array();

        foreach ($this->errors as $e) {
            $field = ucwords(str_replace($this->fieldCharsToRemove, chr(32), $e['field']));
            $param = $e['param'];

            // Let's fetch explicit field names if they exist
            if (array_key_exists($e['field'], self::$fields)) {
                $field = self::$fields[$e['field']];
            }

            switch ($e['rule']) {
                case 'mismatch' :
                    $resp[] = "Não existe regra de validação para o campo <span class=\"$field_class\">$field</span>";
                    break;
                case 'validate_required' :
                    $resp[] = "O campo <span class=\"$field_class\">$field</span> é obrigatório";
                    break;
                case 'validate_valid_email':
                    $resp[] = "O campo <span class=\"$field_class\">$field</span> é obrigatório e precisa ser um endereço de email válido";
                    break;
                case 'validate_max_len':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be $param or shorter in length";
                    break;
                case 'validate_min_len':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be $param or longer in length";
                    break;
                case 'validate_exact_len':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be exactly $param characters in length";
                    break;
                case 'validate_alpha':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain alpha characters(a-z)";
                    break;
                case 'validate_alpha_numeric':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain alpha-numeric characters";
                    break;
                case 'validate_alpha_dash':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain alpha characters &amp; dashes";
                    break;
                case 'validate_numeric':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain numeric characters";
                    break;
                case 'validate_integer':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain a numeric value";
                    break;
                case 'validate_boolean':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain a true or false value";
                    break;
                case 'validate_float':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field may only contain a float value";
                    break;
                case 'validate_valid_url':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field is required to be a valid URL";
                    break;
                case 'validate_url_exists':
                    $resp[] = "The <span class=\"$field_class\">$field</span> URL does not exist";
                    break;
                case 'validate_valid_ip':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to contain a valid IP address";
                    break;
                case 'validate_valid_cc':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to contain a valid credit card number";
                    break;
                case 'validate_valid_name':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to contain a valid human name";
                    break;
                case 'validate_contains':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to contain one of these values: ".implode(', ', $param);
                    break;
                case 'validate_contains_list':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs contain a value from its drop down list";
                    break;
                case 'validate_doesnt_contain_list':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field contains a value that is not accepted";
                    break;
                case 'validate_street_address':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be a valid street address";
                    break;
                case 'validate_date':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be a valid date";
                    break;
                case 'validate_min_numeric':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be a numeric value, equal to, or higher than $param";
                    break;
                case 'validate_max_numeric':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to be a numeric value, equal to, or lower than $param";
                    break;
                case 'validate_starts':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to start with $param";
                    break;
                case 'validate_extension':
                    $resp[] = "The <span class\"$field_class\">$field</span> field can have the following extensions $param";
                    break;
                case 'validate_required_file':
                    $resp[] = "The <span class\"$field_class\">$field</span> field is required";
                    break;
                case 'validate_equalsfield':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field does not equal $param field";
                    break;
                case 'validate_min_age':
                    $resp[] = "The <span class=\"$field_class\">$field</span> field needs to have an age greater than or equal to $param";
                    break;
                default:
                    $resp[] = "The <span class=\"$field_class\">$field</span> field is invalid";
            }
        }

        if (!$convert_to_string) {
            return $resp;
        } else {
            $buffer = '';
            foreach ($resp as $s) {
                $buffer .= "<span class=\"$error_class\">$s</span>";
            }

            return $buffer;
        }
    }
    
    /**
	* @overload GUMP::get_errors_array()
    */
    public function get_errors_array($convert_to_string = null)
    {
        if (empty($this->errors)) {
            return ($convert_to_string) ? null : array();
        }

        $resp = array();

        foreach ($this->errors as $e) {
            $field = ucwords(str_replace(array('_', '-'), chr(32), $e['field']));
            $param = $e['param'];

            // Let's fetch explicit field names if they exist
            if (array_key_exists($e['field'], self::$fields)) {
                $field = self::$fields[$e['field']];
            }

            switch ($e['rule']) {
                case 'mismatch' :
                    $resp[$field] = "There is no validation rule for $field";
                    break;
                case 'validate_required':
                    $resp[$field] = "The $field field is required";
                    break;
                case 'validate_valid_email':
                    $resp[$field] = "The $field field is required to be a valid email address";
                    break;
                case 'validate_max_len':
                    $resp[$field] = "The $field field needs to be $param or shorter in length";
                    break;
                case 'validate_min_len':
                    $resp[$field] = "The $field field needs to be $param or longer in length";
                    break;
                case 'validate_exact_len':
                    $resp[$field] = "The $field field needs to be exactly $param characters in length";
                    break;
                case 'validate_alpha':
                    $resp[$field] = "The $field field may only contain alpha characters(a-z)";
                    break;
                case 'validate_alpha_numeric':
                    $resp[$field] = "The $field field may only contain alpha-numeric characters";
                    break;
                case 'validate_alpha_dash':
                    $resp[$field] = "The $field field may only contain alpha characters &amp; dashes";
                    break;
                case 'validate_numeric':
                    $resp[$field] = "The $field field may only contain numeric characters";
                    break;
                case 'validate_integer':
                    $resp[$field] = "The $field field may only contain a numeric value";
                    break;
                case 'validate_boolean':
                    $resp[$field] = "The $field field may only contain a true or false value";
                    break;
                case 'validate_float':
                    $resp[$field] = "The $field field may only contain a float value";
                    break;
                case 'validate_valid_url':
                    $resp[$field] = "The $field field is required to be a valid URL";
                    break;
                case 'validate_url_exists':
                    $resp[$field] = "The $field URL does not exist";
                    break;
                case 'validate_valid_ip':
                    $resp[$field] = "The $field field needs to contain a valid IP address";
                    break;
                case 'validate_valid_cc':
                    $resp[$field] = "The $field field needs to contain a valid credit card number";
                    break;
                case 'validate_valid_name':
                    $resp[$field] = "The $field field needs to contain a valid human name";
                    break;
                case 'validate_contains':
                    $resp[$field] = "The $field field needs to contain one of these values: ".implode(', ', $param);
                    break;
                case 'validate_street_address':
                    $resp[$field] = "The $field field needs to be a valid street address";
                    break;
                case 'validate_date':
                    $resp[$field] = "The $field field needs to be a valid date";
                    break;
                case 'validate_min_numeric':
                    $resp[$field] = "The $field field needs to be a numeric value, equal to, or higher than $param";
                    break;
                case 'validate_max_numeric':
                    $resp[$field] = "The $field field needs to be a numeric value, equal to, or lower than $param";
                    break;
                case 'validate_min_age':
                    $resp[$field] = "The $field field needs to have an age greater than or equal to $param";
                    break;
                default:
                    $resp[$field] = "The $field field is invalid";
            }
        }

        return $resp;
    }
	
}