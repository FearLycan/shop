<?php


namespace common\components;


class Helper
{
    public static function getStatusLabel($model)
    {
        switch ($model->status) {
            case 0:
                return '<span class="label label-danger uppercase">' . $model->getStatusName() . '</span>';
                break;
            case 1:
                return '<span class="label label-success uppercase">' . $model->getStatusName() . '</span>';
                break;
            default:
                return '<span class="label label-default uppercase">' . $model->getStatusName() . '</span>';
        }
    }
}
