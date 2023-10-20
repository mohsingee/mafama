<?php
namespace App\Helpers;
use Request;
use App\LogActivity as LogActivityModel;
class LogActivity
{
    public static function addToLog($subject,$action="",$data=array(),$notification="")
    {

        $desc=json_encode($data);
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['username'] = auth()->check() ? auth()->user()->name : '';
        $log['action'] = $action;
        $log['description'] = $desc;
        $log['notification'] = $notification;
    	LogActivityModel::create($log);

    }
    public static function logActivityLists()
    {
    	return LogActivityModel::orderBy('id','desc')->get();
    }





}