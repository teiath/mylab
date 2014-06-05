<?php
//classes from Aura.PHP.Filter

class Validator
{
    protected static $trueValues = array('1', 'on', 'true', 't', 'yes', 'y');
    
    protected static $falseValues = array('0', 'off', 'false', 'f', 'no', 'n');

    protected static $maleValues = array('Α', 'M');
    protected static $femaleValues = array('Γ', 'F');
    protected static $transitionSourceValues = array('mylab', 'mmsch');
    protected static $activeLabSourceValues = array('1', 'ΕΝΕΡΓΟΣ');
    protected static $inactiveLabSourceValues = array('3', 'ΑΝΕΝΕΡΓΟΣ');
    protected static $trueValue = array('true');
    protected static $falseValue = array('false');
    protected static $fivestars = array('1','2','3','4','5');
    
    /**
     * 
     * Validates that value has exist.
     * 
     *  Use php get_object_vars function that returns NULL if the object isn't an object
     *  Use php array_key_exists function that checks if the given key or index exists in the array.
     * 
     * @return bool True on success, false on failure.
     * 
     */
    public static function IsExists($param) {
        $params = get_object_vars( loadParameters() );     
    return array_key_exists($param, $params);
    }

    /**
     * 
     * Validates that value has missing from array list.
     * 
     * @return bool True if exist, false if not.
     * 
     */
    public static function isMissing($param) {
        return ! self::IsExists($param);
    }
    
    /**
     * 
     * Validates that the value is a boolean representation.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsBoolean($value)
    {
        if ($value === true || $value === false) {
            return true;
        }

        $lower = strtolower(trim($value));
        if (in_array($lower, self::$trueValues, true)) {
            return true;
        } elseif (in_array($lower, self::$falseValues, true)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * Forces the value to a boolean.
     * 
     * Note that this recognizes $this->trueValues and $this->falseValues values.
     * 
     * @return bool Always true.
     * 
     */
    public static function ToBoolean($value)
    {
        // PHP booleans
        if ($value === true )
            return true;
        else if ($value === false )
            return false;

        $lower = strtolower(trim($value));
        if (in_array($lower, self::$trueValues, true)) {
            return true;
        } elseif (in_array($lower, self::$falseValues, true)) {
            return false;
        } else {
            return null;
        }
        
        return true;
    }
    
    
    /**
     * 
     * Validates that the value has the right representation of type sex.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsSex($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$maleValues, true)) {
            return true;
        } elseif (in_array($lower, self::$femaleValues, true)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * Forces the value to the right representation of type sex .
     * 
     * Note that this recognizes $this->$maleValues and $this->$femaleValues values.
     * 
     * @return ("Α" or "Γ") True if valid, null if not.
     * 
     */
    public static function ToSex($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$maleValues, true)) {
            return 'Α';
        } elseif (in_array($lower, self::$femaleValues, true)) {
            return 'Γ';
        } else {
            return null;
        }
        
        return true;
    }
    
    /**
     * 
     * Validates that the value has the right representation of five star system.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsFiveStarSystem($value)
    {
        if (in_array($value, self::$fivestars, true)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * Forces the value to the right representation of type five star system.
     * 
     * @return bool True if valid, null if not.
     * 
     */
    public static function ToFiveStarSystem($value)
    {

        if (in_array($value, self::$fivestars, true)) {
            return (int)$value;
        } else {
            return null;
        }
        
        return true;
    }
    
    
     /**
     * 
     * Validates that the value has the right representation of type transition_source.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsTransitionSource($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$transitionSourceValues, true)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * Forces the value to the right representation of type transition_source.
     * 
     * @return bool True if valid, null if not.
     * 
     */
    public static function ToTransitionSource($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$transitionSourceValues, true)) {
            return $lower;
        } else {
            return null;
        }
        
        return true;
    }   
 
    /**
     * 
     * Validates that the value has the right representation of type worker_state.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsWorkerState($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$activeLabSourceValues, true)) {
            return true;
        } elseif (in_array($lower, self::$inactiveLabSourceValues, true)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * Forces the value to the right representation of type worker_state.
     * 
     * @return bool True if valid, null if not.
     * 
     */
    public static function ToWorkerState($value)
    {
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$activeLabSourceValues, true)) {
            return '1';
        } elseif (in_array($lower, self::$inactiveLabSourceValues, true)) {
            return '3';
        } else {
            return null;
        }
        
        return true;
    }
    
    /**
     * 
     * Validates that the value is null, or is a string composed only of
     * whitespace.
     * 
     * Non-strings and non-nulls never validate as blank; this includes
     * integers, floats, numeric zero, boolean true and false, any array with
     * zero or more elements, and all objects and resources.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsNull($value)
    {
        // nulls are blank
        if (is_null($value)) {
            return true;
        }
        
        // strings with 'null' means blanks
        if (strtolower(trim($value)) == "null" ) {
            return true;
        }

        // non-strings are not blank: int, float, object, array, resource, etc
        if (! is_string($value)) {
            return false;
        }
        
        // strings that trim down to exactly nothing are blank
        return trim($value) === '';
    }

    /**
     * 
     * Set value to null
     * 
     * @return bool Always true.
     * 
     */
    public static function ToNull($value) 
    {
        return null;       
    }
    
    /**
     * 
     * Validates that the value is an array representation.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsArray($value,$separator = ',')
    {
            if ($separator == '=')
            return ( count( explode($separator, $value , 3) ) > 1 );
            
        return ( count( explode($separator, $value) ) > 1 );
    }

    /**
     * 
     * Forces the value to an array.
     * 
     * @return array Array if true, null if false.
     * 
     */
    public static function ToArray($value, $separator = ',')
    {
//        if (!self::IsArray($value))
//            return null;
            if ($separator == '='){
                return array_map('trim', explode($separator, $value,3));
            }
            
       return array_map('trim', explode($separator, $value));
    }

    /**
     * 
     * Validates that the value is a negative number.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsNegative($value)
    {
        if (! is_scalar($value)) {
            return false;
        }
        
        return ( is_int($value) || (is_numeric($value) && $value == (int) $value) )  && ( $value <= 0 );
    }
    
    /**
     * 
     * Validates that the value is an number. 
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsNumeric($value)
    {
        if (! is_scalar($value)) {
            return false;
        }
        
        return ( is_int($value) || (is_numeric($value) && $value == (int) $value) );
    }

    /**
     * 
     * Forces the value to numeric.
     * 
     * @return int Value as integer if true, null if false.
     * 
     */
    public static function ToNumeric($value)
    {
        if (!self::IsNumeric($value))
            return null;
        
        return (int)$value;
    }
    
    /**
     * 
     * Validates that the value is a positive number, and mean an ID representation .
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function IsID($value)
    {
        $value=trim($value);
        if (! is_scalar($value)) {
            return false;
        }
        
        return ( is_int($value) || (is_numeric($value) && $value == (int) $value) )  && ( $value > 0 );
    }
    
    
    /**
     * 
     * Forces the value to ID integer format.
     * 
     * @return int Value as ID integer if true, null if false.
     * 
     */    
    public static function ToID($value)
    {
        if (!self::IsID($value))
            return null;
        
        return trim($value);
    }
    
    /**
     * 
     * Validates that the value is a value representation with regular_expressions
     * '/[A-Z]|[a-z]|[Α-Ω]|[α-ω]|[0-9]|[\-\/@#$;?_%^&*!,. ]/' .
     * 
     * Use php preg_match function that returns 1 if the pattern matches given subject,
     * 0 if it does not, or FALSE if an error occurred
     * 
     * @return mixed 1,0,FALSE if valid, false if null or boolean of 0 or 1.
     * 
     */
    public static function IsValue($value)
    {
        if ( self::IsNull($value) )
            return false;
        
        if (!in_array($value, array(0, 1)))
        {
            //echo $value;
            if ( self::IsBoolean($value) )
            return false;
        }
                
        return preg_match('/[A-Z]|[a-z]|[Α-Ω]|[α-ω]|[0-9]|[=\-\/@#$;?_%^&*!,.]/', $value);
    }
    
    /**
     * 
     * Forces the value to string format with trim property.
     * 
     * @return string Value as trimmed string if true, null if false.
     * 
     */   
    public static function ToValue($value)
    {
        if (!self::IsValue($value))
            return null;
        
        return (string)trim($value);
    }
  
    /**
     * 
     * Validates that the value is a year type representation of 4 digits with regular_expressions
     * '/[0-9]{4}]/' .
     * 
     * Use php preg_match function that returns 1 if the pattern matches given subject,
     * 0 if it does not, or FALSE if an error occurred
     * 
     * @return mixed 1,0,FALSE if valid, false if null or boolean of 0 or 1.  
     */
    public static function IsYear($value)
    {
     
        if(! ctype_digit($value))
            return false;
        
        return preg_match("/^[0-9]{4}+$/", $value); 
    }
    
    /**
     * 
     * Forces the value to year format with trim property.
     * 
     * @return string Value as trimmed year type of 4 digits if true, null if false.
     * 
     */ 
    public static function ToYear($value)
    {
        if(! ctype_digit($value))
            return null;
        
        return (int)trim($value);
    }

    /**
     * 
     * Validates that the value is a year type representation of 4 digits with regular_expressions
     * '/[0-9]{4}]/' and has valid year-range.
     * 
     * Use php preg_match function that returns 1 if the pattern matches given subject,
     * 0 if it does not, or FALSE if an error occurred
     * 
     * @return mixed 1,0,FALSE if valid, false if null or boolean of 0 or 1.  
     */
    public static function IsValidYear($value)
    {

        if(! ctype_digit($value))
            return false;
        
        if( (int)$value > (date("Y")) || (int)$value < 1975)
        return false;
        
        return preg_match("/^[0-9]{4}+$/", $value); 
    }

    /**
     * 
     * Validates that the value is a date type representation of various format
     * 
     * 
     * Use system date.php functions that returns true if date type found,
     *  or false if an error occurred
     * 
     * Function found by http://php.net/checkdate post by glavic
     * Examples :
     * var_dump(IsDate('2012-02-28 12:12:12')); # true
     * var_dump(IsDate('2012-02-30 12:12:12')); # false
     * var_dump(IsDate('28/02/2012', 'd/m/Y')); # true
     * var_dump(IsDate(14, 'H')); # true
     * var_dump(IsDate('2012-02-28T12:12:12+02:00', DateTime::ATOM)); # true
     * var_dump(IsDate('Tue, 28 Feb 2012 12:12:12 +0200', 'D, d M Y H:i:s O')); # true
     * 
     * @return bool True if valid, false if not. 
     */ 
   public static function IsDate($date, $format = 'Y-m-d H:i:s')
    {
        $date=date($format, trim(strtotime($date)));
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    /**
     * 
     * Forces the value to year format with trim property.
     * 
     * @return string Value as trimmed year type if true, null if false.
     * 
     */ 
    public static function ToDate($date, $format = 'Y-m-d H:i:s')
    {   

        return date($format, trim(strtotime($date)));
    }
    
    /**
     * 
     * Validates that the value has valid year-range.
     * 
     * Use php strtotime function to compare date by user with currentDate and startDate
     * true condition must have startDate < date < currentDate
     * 
     * @return bool True if valid, false if not.  
     */
    public static function IsValidDate($date, $format = 'Y-m-d H:i:s')
    {

      $startDate="1975-1-1";   //min date value
      $currentDate=date($format);  //max date value
      $formatDate = date($format, strtotime($date));
     
     if ( (strtotime($formatDate) > strtotime($startDate) ) && (strtotime($formatDate) <= strtotime($currentDate) ) ){
          return true;  
        } else {
          return false;
        }

    }
    
    /**
     * 
     * Validate the object if unique 
     * 
     * @return bool True if unique, false if not
     * 
     */ 
    public static function IsUniqueObject($value)
    {   
        $counter =count($value);
        $check = array_unique($value,SORT_REGULAR);
        $found = ($counter != $check) ? false:true;
        
        return $found;    
    }
    
    /**
     * 
     * Forces the object array to unique array
     * 
     * @return object Unique values of object
     * 
     */ 
    public static function ToUniqueObject($value)
    {   
        
        return array_values(array_unique($value,SORT_REGULAR));    
    }
    
    /**
     * 
     * Validate the string if unique 
     * 
     * @return bool True if unique, false if not
     * 
     */ 
    public static function IsUniqueString($value, $explode_value=', ')
    {   
        $counter =count($value);
        $check_unique = implode($explode_value,array_unique(explode($explode_value, $value)));
        $check =count($check_unique);
        $found = ($counter != $check) ? false:true;
        
        return $found;    
    }
    
    /**
     * 
     * Forces the string to unique string by explode
     * 
     * @return object Unique values of string by explode
     * 
     */ 
    public static function ToUniqueString($value, $explode_value=', ')
    {   
        return implode($explode_value,array_unique(explode($explode_value, $value)));  
    }
    
    /**
     * 
     * Validate if value is true
     * 
     * @return bool True if true, false if not
     * 
     */ 
    public static function IsTrue($value)
    {   
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$trueValue, true)) {
            return true;
        } else {
            return false;
        }
    
    }
    
    /**
     * 
     * Validate if value is true
     * 
     * @return bool True if true, false if not
     * 
     */ 
    public static function ToTrue($value)
    {   
        $lower = strtolower(trim($value));
        if (in_array($lower, self::$trueValue, true)) {
            return 'true';
        } else {
            return null;
        }

    }
    
    /**
     * 
     * Validate if value is empty
     * 
     * @return bool True(1) if empty, false if not empty , null if isn't array type
     * 
     */ 
    public static function IsEmptyArray($value)
    {   
        
        if (!is_array($value))
            return null;
            
        if (empty($value) && count($value==0)) 
            return true;
        else 
            return false;
        
    }
 
    /**
     * 
     * Forces array to empty
     * 
     * @return array, Return empty array
     * 
     */ 
    public static function ToEmptyArray($value)
    {   
        if (!is_array($value))
            return null;
        
        $value = array();
        
        return $value;
        
    }
    
    /**
     * 
     * Validates that the value is a integer representation.
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function isInteger($value) {
    if (! is_scalar($value)) {
        return false;
    }

    return ( is_int($value) || (is_numeric($value) && $value == (int)$value) );
    }

    /**
     * 
     * Forces the value to integer.
     * 
     * @return int Value as integer if true, null if false.
     * 
     */
    public static function toInteger($value) {
        return (int)$value;
    }
    
    /**
     * 
     * Check if a value is greater than another value.
     * 
     * params $value -> the value to check
     *        $max -> the value for compare
     *        $maxIncluded -> default false " > ", set true to " >= " 
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function isGreaterThan($value, $max, $maxIncluded = false) {
    if (! is_scalar($value)) {
        return false;
    }

        return (self::isInteger($value) && ($maxIncluded ? $value >= $max : $value > $max));
    }
    
    /**
     * 
     * Check if a value is lower than another value.
     * 
     * params $value -> the value to check
     *        $max -> the value for compare
     *        $minIncluded -> default false " < ", set true to " <= " 
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function isLowerThan($value, $min, $minIncluded = false) {
        if (! is_scalar($value)) {
            return false;
        }

        return (self::isInteger($value) &&  ($minIncluded ? $value <= $min : $value < $min));
    }

    /**
     * 
     * Check if a value is equal to another value.
     * 
     * params $value -> the value to check
     *        $val -> the value for compare
     * 
     * @return bool True if valid, false if not.
     * 
     */
    public static function isEqualTo($value, $val) {
        if (! is_scalar($value)) {
            return false;
        }

        return (self::isInteger($value) &&  ($value == $val));
    }
    
}
?>