<?php

include 'functions.php';

header("Content-type: text/xml");

/**
 * Now we'll combine Revision 3 with an interface to put some fine-grained
 *   control of the white and blacklists via SMS.
 */

$from = preg_replace("/[^0-9]/", "", $_POST['From']);

$allowed = is_allowed_adv($from, 7, 15);

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