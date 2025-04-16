<?php

trait CheckLocalTraits
{
    public function isLocal()
    {
        $check = explode('127.0.0.1', url('/'));
        if (count($check) > 1)
            return true;
        return false;
    }
}
