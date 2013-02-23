<?php

include 'functions.php';

header("Content-type: text/xml");

/**
 * Simple call forwarding
 *
 * The library below generates this:
 * <Response>
 *   <Dial>703-555-1212</Dial>
 * </Response>
 */

$response = new Services_Twilio_Twiml();
$response->dial($toPhone);

print $response;