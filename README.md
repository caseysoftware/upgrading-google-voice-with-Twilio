
Upgrading Google Voice to Twilio
======================

A few months ago, I realized that while Google Voice is great, it doesn't fit all of my needs. I don't have a way to collect the incoming calls and voice mails to do anything further with them. I also don't get the context of the person or what they could be calling about until the call comes through.

So what originally started as a proof of concept, has turned into this..

## Getting started

You need to have a Twilio account. Then copy the creds-dist.php file to creds.php and fill in the credentials you plan to use. Then set the voice and sms urls to wherever your script lives.

Here is what each script does:

*  Rev 1 - simple call forwarding
*  Rev 2 - the above with built in voice mail and email (closest to Google Voice)
*  Rev 3 - all of the above with built in working hours and phone number whitelisting
*  Rev 4 - all of the above with SMS-based control of whitelisting and blacklisting of individual phone numbers

By default, this script uses a simple SQLite database. There's nothing wrong with that for small-scale operations but for larger scale systems, you should switch to a real database like Mysql or Postgres.

## TODO

*  Integrate with a CRM (Salesforce, SugarCRM, LanternCRM, Contactually) to log call information (start time, duration, recording)
*  Integrate with a CRM to collect information pre-call and deliver a "whisper"
*  Implement a proxy for outbound calling, ideally integrated with a CRM so I don't have to remember numbers
*  Integrate with a calendar to do more intelligence routing based on working hours relative to current timezone and/or offline during meetings

## Oddities

This doesn't perfectly implement the SMS side of Google Voice. The way GV works is that when someone texts your GV number, it is forwarded to you via a separate phone number. When someone else texts your GV number, it is forwarded to you under yet another number. This allows you to respond to each and the messages are routed to the proper recipients. To implement the same with this script, we would have to purchase a different Twilio number for each interaction. We can recycle them across conversations with different users but it's not super scalable.

### MIT License

Copyright (C) 2013, Twilio Inc

Developed by Keith Casey <keith at twilio dot com>

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
