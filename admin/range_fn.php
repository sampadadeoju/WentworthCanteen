<?php
    // Date range related function

    function rangeWeek($datestr) {
        // Set Sydney timezone (AEST/AEDT)
        date_default_timezone_set('Australia/Sydney');
        
        $dt = strtotime($datestr);
        return array(
            "start" => date('N', $dt) == 1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt)),
            "end" => date('N', $dt) == 7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt))
        );
    }

    function rangeMonth($datestr) {
        // Set Sydney timezone (AEST/AEDT)
        date_default_timezone_set('Australia/Sydney');
        
        $dt = strtotime($datestr);
        return array(
            "start" => date('Y-m-d', strtotime('first day of this month', $dt)),
            "end" => date('Y-m-d', strtotime('last day of this month', $dt))
        );
    }
?>
