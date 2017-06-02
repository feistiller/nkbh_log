<?php
/**
 * Created by PhpStorm.
 * User: stiller
 * Date: 2017/6/2
 * Time: 10:03
 * 日志打印类
 */
namespace Lib\myTools;
//引入IP类
include_once("GetHostInfo.class.php");
class M_Log
{
    private $baseLogUrl,$debugLogUrl,$toolsLogUrl,$ip;
    //构造方法
    public function __construct()
    {
        $date=date('Y-m-d');
        $this->baseLogUrl=dirname(__FILE__)."/../ServerData/BaseLog/".$date.'.log';
        $this->debugLogUrl=dirname(__FILE__)."/../ServerData/DebugLog/".$date.'.log';
        $this->toolsLogUrl=dirname(__FILE__)."/../ServerData/ToolsLog/".$date.'.log';
        $temp=new GetHostInfo();
        $this->ip=$temp::getIP();
    }

    //debug 日志
    function debugLog($info)
    {
        $time = date('m-d H:i:s');
        $backtrace = debug_backtrace();
        $backtrace_line = array_shift($backtrace); // 哪一行调用的log方法
        $backtrace_call = array_shift($backtrace); // 谁调用的log方法
        $file = substr($backtrace_line['file'], strlen($_SERVER['DOCUMENT_ROOT']));
        $line = $backtrace_line['line'];
        $class = isset($backtrace_call['class']) ? $backtrace_call['class'] : '';
        $type = isset($backtrace_call['type']) ? $backtrace_call['type'] : '';
        $func = $backtrace_call['function'];
        file_put_contents($this->debugLogUrl, "$time $this->ip $file:$line $class$type$func: $info\n", FILE_APPEND);
    }

    //打印追踪日志
    function toolsLog($format)
    {
        $args = func_get_args();
        array_shift($args);
        $d = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
        $info = vsprintf($format, $args);
        $data = sprintf("%s %s,%d: %s\n", date("Ymd His"), $d["file"], $d["line"], $info);
        file_put_contents($this->toolsLogUrl, $data, FILE_APPEND);
    }

    //基本的打印API请求日志输出
    function baseLog($info)
    {
        return file_put_contents($this->baseLogUrl, date("Y-m-d H:i:s") .$this->ip. " " . $info . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
