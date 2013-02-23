<?php

include 'functions.php';

header("Content-type: text/xml");

/**
 * This call happens asychronously so we don't have to generate TwiML.
 */

$filter     = "!@#$^&%*()+=-[]\/{}|:<>?,.";
$recording  = preg_replace("/[$filter]/", "", $_POST['RecordingUrl']);
$transcript = preg_replace("/[$filter]/", "", $_POST['TranscriptionText']);

$from   = preg_replace("/[^0-9]/", "", $_GET['From']);

$subject = "You have a new voicemail transcription from " . $from;
$body = "You received voicemail." .
            "\n\nHere is the recording: $recording" .
            "\n\nAnd here is the transcription:\n $transcript";

mail($toEmail, $subject, $body);