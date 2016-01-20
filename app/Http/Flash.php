<?php
namespace App\Http;

class Flash {

    /**
     * Show message of certain type
     *
     * @param $title
     * @param $message
     * @param $type
     * @param $timer
     * @param $key
     */
    public function show($title, $message, $type, $timer, $key = 'flash_notification')
    {
        if($key == 'flash_notification_aside')
        {
            session()->flash($key, ['message' => $message]);
            return;
        }

        session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
            'timer'   => $timer,
        ]);

        if ($timer > 0 && $key != 'flash_notification_overlay') {
            session()->flash($key . '.timer', $timer);
        }
    }

    /**
     * Show info message
     *
     * @param $title
     * @param $message
     * @param int $timer
     */
    public function info($title, $message, $timer = 0)
    {
        $this->show($title, $message, 'info', $timer);
    }

    /**
     * Show success message
     *
     * @param $title
     * @param $message
     * @param int $timer
     */
    public function success($title, $message, $timer = 0)
    {
        $this->show($title, $message, 'success', $timer);
    }

    /**
     * Show error message
     *
     * @param $title
     * @param $message
     * @param int $timer
     */
    public function error($title, $message, $timer = 0)
    {
        $this->show($title, $message, 'error', $timer);
    }

    /**
     * Show warning message
     *
     * @param $title
     * @param $message
     * @param int $timer
     */
    public function warning($title, $message, $timer = 0)
    {
        $this->show($title, $message, 'warning', $timer);
    }

    /**
     * Show overlay message
     *
     * @param $title
     * @param $message
     */
    public function overlay($title, $message)
    {
        $this->show($title, $message, 'info', 0, 'flash_notification_overlay');
    }

    /**
     * Show message on the side
     *
     * @param $message
     */
    public function aside($message)
    {
        $this->show(null, $message, 'aside', 0, 'flash_notification_aside');
    }
}