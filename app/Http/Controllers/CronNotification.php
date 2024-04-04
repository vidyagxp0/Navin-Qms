<?php

namespace App\Http\Controllers;

use Helpers;
use Illuminate\Support\Facades\Mail;
use App\Models\Deviation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CronNotification extends Controller
{
    public function sendNotificationBeforeFiveDueDate()
    {
      //  $deviation = new Deviation();
        $fiveDaysFromNow = Carbon::now()->addDays(5)->startOfDay();

        $deviation = Deviation::where('due_date', $fiveDaysFromNow)->get();
        $list = Helpers::getCEOUserList();
        foreach ($deviation as $dueDate) {
                foreach ($list as $u) {
           // if ($u->q_m_s_divisions_id == $deviation->division_id) {
               
                    // Send notification via email
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.duedateapproaching',
                            ['data' => $dueDate],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Activity Performed By " . Auth::user()->name);
                            }
                        );
                    }
                }
            //}
        }
    }
}
