<?php
/**
 * Created by PhpStorm.
 * User: kalebclark
 * Date: 6/29/16
 * Time: 1:25 PM
 */

//namespace App\Http\Responses;
namespace XBLD\ApiResponse;

//use Illuminate\Http\Response;
use Carbon\Carbon;

class APIResponse
{
    
    public $status;
    public $messages;
    public $payload;
    protected $statusCode;
    public $input_vars;

    public function __construct()
    {
        $this->status = true;
        $this->messages = [];
    }
    
    public function addMessage($message)
    {
        array_push($this->messages, $message);
    }
    
    public function getMessages()
    {
        return $this->messages;
    }
    
    public function setCode($code)
    {
        $this->statusCode = $code;
    }
    
    public function getCode()
    {
        return $this->statusCode;
    }
    
    public function response()
    {
        $date_time = Carbon::now();
        $content = [
            'status'    => $this->status,
            'messages'  => $this->messages,
            'data'      => $this->payload
        ];

        // IF DEBUG
//        $content['debug'] = [
//            'input_vars'    => $this->input_vars
//        ];

        $content['completed_at'] = $date_time->toDateTimeString();

        if($this->statusCode) {
            return response($content, $this->statusCode);
        } else {
            return response($content);
        }

    }
}