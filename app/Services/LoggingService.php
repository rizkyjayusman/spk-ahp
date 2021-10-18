<?php

namespace App\Services;

use App\Constants\LogType;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggingService
{
    public function generateLog($type, $message)
    {
        $log = ['userId' => \Auth::user()->id,
            'message' => $message];
        $newMaskingLog = new Logger($type);
        $newMaskingLog->pushHandler(new StreamHandler(storage_path('logs/'.$type.'-'.date('Ymd').'.log')), Logger::INFO); //for group by date
        // $newMaskingLog->pushHandler(new StreamHandler(storage_path('logs/'.$type.'-'.time().'.log')), Logger::INFO);
        return $newMaskingLog->info($type, $log);
    }

    public function userLogin($id)
    {
        $type = LogType::LOGIN_ACTIVITY;
        $message = config('bigbox.log.type.login.message');

        return $this->generateLog($type, $message);
    }

    public function addUser()
    {
        $type = LogType::USER_MANAGEMENT;
        $message = config('bigbox.log.type.user-management.new-user.message');

        return $this->generateLog($type, $message);
    }

    public function editUser()
    {
        $type = LogType::USER_MANAGEMENT;
        $message = config('bigbox.log.type.user-management.edit-user.message');

        return $this->generateLog($type, $message);
    }

    public function deleteUser()
    {
        $type = LogType::USER_MANAGEMENT;
        $message = config('bigbox.log.type.user-management.delete-user.message');

        return $this->generateLog($type, $message);
    }

    public function downloadTrafficReport()
    {
        $type = LogType::TRAFFIC_REPORT;
        $message = config('bigbox.log.type.traffic-report.message');

        return $this->generateLog($type, $message);
    }
}
