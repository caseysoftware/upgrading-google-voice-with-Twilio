<?php

include 'functions.php';

/**
 * Now we'll combine Revision 3 with an interface to put some fine-grained
 *   control of the white and blacklists via SMS.
 */

$from = preg_replace("/[^0-9]/", "", $_POST['From']);
$body = preg_replace("/[^a-z0-9\ ]/", "", trim(strtolower($_POST['Body'])));

$message = process_command($body);

$response = new Services_Twilio_Twiml();
if ($toPhone == $from) {
    $response->sms($message);
}

print $response;