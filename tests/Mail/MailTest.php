<?php

namespace Tests\Mail;


use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{


    /** @test */
    public function see_email_was_sent()
    {

        // todo tests with https://mailtrap.io/inboxes
        Mail::fake();


        // Assert a mailable was sent twice...
        Mail::assertSent(TestMail::class, 1);


    }

}
