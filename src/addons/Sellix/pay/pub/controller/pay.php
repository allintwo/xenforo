<?php
namespace Sellix\pay\pub\controller;
use XF\pub\controller\AbstractController;


class pay extends \XF\Pub\Controller\AbstractController
{

    public  function actionIndex()
    {

        $viewParams = [
            'nono' => 'you name is nono khan'
        ];
        return $this->view('Sellix\pay:pay\Index','Sellix_pay',$viewParams);
    }
}