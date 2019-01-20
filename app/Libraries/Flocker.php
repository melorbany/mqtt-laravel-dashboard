<?php

namespace App\Libraries;


/**
 * Class Flocker
 * @package App\Libraries
 */

class Flocker {
    private $lock_name = null;
    private $fp = null;
    private $locked = false;

    /**
     * Flocker constructor.
     * @param $name
     * @param null $cmd
     */
    function __construct($name, $cmd = null) {
        $this->lock_name = str_replace(':', '_', $name);
        $file_name = '/tmp/RAQEB_LOCK_' . $this->lock_name . '_CMD.txt';
        $this->fp = fopen($file_name , 'w+');
        if (!flock($this->fp, LOCK_EX | LOCK_NB)) { // do an exclusive lock
            $this->locked = true;
        }
    }

    /**
     *
     */
    function __destruct() {
        flock($this->fp, LOCK_UN); // release the lock
    }

    /**
     * @return bool
     */
    public function alreadyRunning()
    {
        return $this->locked;
    }
}
