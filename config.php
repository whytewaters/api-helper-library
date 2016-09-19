<?php

$CONF['RTBS_API_HOST'] = 'https://dev.rtbstraining.com';
$CONF['RTBS_API_KEY'] = 'YOUR_KEY_HERE';
$CONF['RTBS_API_PASSWORD'] = 'YOUR_PASSWORD_HERE';

//Define each $CONF entry as a global constant
foreach ($CONF as $key => $val) {
    define($key, $val);
}

unset($key);
unset($val);