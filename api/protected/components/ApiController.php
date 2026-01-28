<?php
class ApiController extends Controller
{
    public $layout = false;

    protected function json($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo CJSON::encode($data);
        Yii::app()->end();
    }
public function actionTest()
    {
        echo "hjhbh"; exit;
    }
}

