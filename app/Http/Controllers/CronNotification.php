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
    public function sendNotificationBeforeSevenDueDate()
    {
      //  $deviation = new Deviation();
        $sevenDaysFromNow = Carbon::now()->addDays(7)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $sevenDaysFromNow)->get();
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


    public function sendNotificationBeforeSixDueDate()
    {
      //  $deviation = new Deviation();
        $sixDaysFromNow = Carbon::now()->addDays(6)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $sixDaysFromNow)->get();
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

    public function sendNotificationBeforeFiveDueDate()
    {
      //  $deviation = new Deviation();
        $fiveDaysFromNow = Carbon::now()->addDays(5)->startOfDay()->toDateString();

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

    public function sendNotificationBeforeFourDueDate()
    {
      //  $deviation = new Deviation();
     $fourDaysFromNow = Carbon::now()->addDays(4)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $fourDaysFromNow)->get();
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


    public function sendNotificationBeforeThreeDueDate()
    {
      //  $deviation = new Deviation();
    echo  $threeDaysFromNow = Carbon::now()->addDays(3)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $threeDaysFromNow)->get();
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
    
    public function sendNotificationBeforeTwoDueDate()
    {
      //  $deviation = new Deviation();
    echo  $twoDaysFromNow = Carbon::now()->addDays(2)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $twoDaysFromNow)->get();
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

    public function sendNotificationBeforeOneDueDate()
    {
      //  $deviation = new Deviation();
    echo  $oneDaysFromNow = Carbon::now()->addDays(1)->startOfDay()->toDateString();

        $deviation = Deviation::where('due_date', $oneDaysFromNow)->get();
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
