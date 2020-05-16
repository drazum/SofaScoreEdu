<?php

namespace Dispatch;

interface IDispatcher{
    public function getInstance(): object;
    public function dispatch();
}
