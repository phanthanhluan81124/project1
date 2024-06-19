<?php

namespace Luan\Project1\Controllers;
use eftec\bladeone\BladeOne;

class BaseController {
    public function renderAdmin($view, $data = [])
    {
        $viewDir = './src/Views/Admin';
        $blade = new BladeOne($viewDir);
        echo $blade->run($view,$data);
    }
    public function renderClient($view, $data = [])
    {
        $viewDir = './src/Views/Client';
        $blade = new BladeOne($viewDir);
        echo $blade->run($view,$data);
    }
}