<?php

namespace System\Events;

class Event{
    /**
     * Events
     */
    /**
     * Event Constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * set up an event
     * 
     * @param string $name
     * @param callback $action
     * @param int $priority = 0
     * @return void
     */
    public static function set(string $name, callable $action, int $priority = 0)
    {
        static::$events[$name][] = [
            'priority' => $priority,
            'action' => $action
        ];
        return null;        
    }

    /**
     * call an event
     * 
     * @param string $name
     * @param array $data = []
     * @return mixed
     */
    public static function call(string $name, array $data = [])
    {
        $events = static::$events;
        if (!isset($events[$name])) {
            return debug(function(){
                throw new \Exception("There are no Event to run", 1);
            }, 0);
        }
        $data = $events[$name];

        usort($data, function($a, $b){
            return $b['priority'] <=> $a['priority'];
        });
        
        foreach ($data as $event) {
            #call_user_func_array($event['action'], $data);
            $event['action'](...$data);
        }

        return null;
    }
}