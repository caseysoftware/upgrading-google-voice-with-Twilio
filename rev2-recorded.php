<?php

include 'creds.php';
include 'vendor/autoload.php';

header("Content-type: text/xml");

/**
 * No one answered the call, so we've gone to voicemail. This emails us a url to the recording.
 *
 * The library below generates this:
 * <Response>
 *   <Hangup />
 * </Response>
 */

$filter     = "!@#$^&%*()+=-[]\/{}|:<>?,.";
$recording  = preg_replace("/[$filter]/", "", $_POST['RecordingUrl']);
$duration   = (int) $_POST['RecordingDuration'];

$from       = preg_replace("/[^0-9]/", "", $_GET['From']);

$subject = "You have a new voicemail from " . $from;
$body = "You received a $duration second voicemail." .
            "\n\nHere is the recording: " . $recording;

mail($toEmail, $subject, $body);

$response = new Services_Twilio_Twiml();
$response->hangup();

print $response;