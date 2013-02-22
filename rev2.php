<?php

include 'creds.php';
include 'vendor/autoload.php';

header("Content-type: text/xml");

/**
 * Now we'll have call forwarding with voicemail
 *
 * The default timeout is 30 seconds but I've found 20 feels more natural.
 *
 * The library below generates this:
 * <Response>
 *   <Dial timeout="20" action="rev2-answered.php">703-555-1212</Dial>
 *   <Say>Please leave your message after the tone</Say>
 *   <Record action="rev2-recorded.php" transcribeCallback="rev2-transcribed.php" />
 * </Response>
 */

$from = preg_replace("/[^0-9]/", "", $_POST['From']);

$response = new Services_Twilio_Twiml();
$response->dial($toPhone, array('timeout' => 5));
$response->say('Please leave your message after the tone');

/**
 * In the record verb, our parameters decide which emails we get. If we keep..
 *
 *  - action -> the email will have the audio url as soon as the recording is ready;
 *  - transcribeCallback -> the email will have the audio url and the transcription once both are ready;
 *
 *  - BOTH -> we'll get both of the above emails.
 */
$response->record(array(
    'action' => 'rev2-recorded.php?From=' . $from,
    'transcribeCallback' => 'rev2-transcribed.php?From=' . $from,
    // Note: since we used transcribeCallback, 'transcribe' => 'true' is assumed
));

print $response;