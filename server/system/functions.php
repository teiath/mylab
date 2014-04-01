<?php

header("Content-Type: text/html; charset=utf-8");

function isJson($string) {
  json_decode($string);
  return (json_last_error() == JSON_ERROR_NONE);
}

function EmptyStringOnNull($arg)
{
    if (is_null($arg)) {
        $arg = "";
    }
    
    return $arg;
}

function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}

function getIDFromValuesArray($value, $array)
{
    foreach ($array as $id => $arr)
    {
        if ($arr["Name"] == $value)
        {
            return $id;
        }
    }
    
    return false;
}

function humanTiming($time)
{
    $value = "";
    
    $diff = time()-$time;
    $daysDiff = floor($diff/60/60/24);
    if ($daysDiff) $value .= $daysDiff.' day'.($daysDiff > 1 ? 's' :'');
    
    $diff -= $daysDiff*60*60*24;
    $hrsDiff = floor($diff/60/60);
    if ($hrsDiff) $value .= ($value ? ', ': '').$hrsDiff.' hour'.($hrsDiff > 1 ? 's' :'');

    $diff -= $hrsDiff*60*60;
    $minsDiff = floor($diff/60);
    if ($minsDiff) $value .= ($value ? ', ': '').$minsDiff.' minute'.($minsDiff > 1 ? 's' :'');

    $diff -= $minsDiff*60;
    $secsDiff = $diff;
    if ($secsDiff) $value .= ($value ? ' and ': '').$secsDiff.' second'.($secsDiff > 1 ? 's' :'');
    
    if (!$value) $value = '0 seconds';
    
    return $value;
}

?>