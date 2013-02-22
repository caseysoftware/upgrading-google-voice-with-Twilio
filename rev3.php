<?php

include 'creds.php';
include 'vendor/autoload.php';
include 'functions.php';

header("Content-type: text/xml");

/**
 * Let's call this 'educated call forwarding' and combine it with the voicemail example
 *
 * There are some people - like maybe a boss or high value customer - that
 *   should ring through every time while other people get voice mail
 *   automatically at certain times.
 */

$whitelist = array('17035551212', '12025551212');

$from = preg_replace("/[^0-9]/", "", $_POST['From']);

$allowed = is_allowed($from, $whitelist, 7, 15);

$response = new Services_Twilio_Twiml();

if ($allowed) {
    $response->dial($toPhone);
} else {
    $response->say("I'm sorry, $name is not available at this time. Please leave a message after the tone.");
    $response->record(array(
        'transcribeCallback' => 'rev2-transcribed.php?From=' . $from,
        // Note: since we used transcribeCallback, 'transcribe' => 'true' is assumed
    ));
}

print $response;