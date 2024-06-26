<?php

namespace App\Mail;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function build()
    {
        return $this->subject('New Booking Notification')
                    ->view('emails.teacher_booking_notification')
                    ->with([
                        'title' => $this->meeting->title,
                        'start_time' => $this->meeting->start_time,
                        'end_time' => $this->meeting->end_time,
                        'meeting_link' => $this->meeting->meeting_link,
                    ]);
    }
}
