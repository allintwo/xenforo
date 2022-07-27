<?php
/**
 * Created by PhpStorm.
 * User: CosMOs
 * Date: 7/27/2022
 * Time: 4:13 AM
 */

namespace Sellix\pay\Admin\controller;
use XF\Admin\controller\AbstractController;


class pay_admin extends \XF\Admin\Controller\AbstractController
{

    public  function actionIndex()
    {

        $viewParams = [
            'nono' => 'you name is nono khan'
        ];
        return $this->view('Sellix\pay:pay_admin\Index','sellix_pay_admin',$viewParams);
    }
}