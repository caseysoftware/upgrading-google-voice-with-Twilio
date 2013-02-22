<?php

/**
 * This is how we determine who is allowed to call through and when.
 *
 * @param type $caller
 * @param type $whitelist
 * @param type $starttime
 * @param type $endtime
 * @return boolean
 */
function is_allowed($number, $whitelist = array(), $starttime = 9, $endtime = 17)
{
    if (in_array($number, $whitelist)) {
        return true;
    }

    $currentHour = date('G');
    if (($starttime <= $currentHour) && ($currentHour < $endtime)) {
        return true;
    }
    
    return false;
}