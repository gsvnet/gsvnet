<?php

class BaseController extends Controller {

    public function __construct()
    {
        \Former::framework('TwitterBootstrap3');
    }
}