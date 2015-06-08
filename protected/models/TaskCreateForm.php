<?php

class TaskCreateForm extends CFormModel
{
    public $taskname;
    public $task;
    public $tip;
    public $code;

    private $_identity;

    public function rules()
    {
        return array(
            array('task, tip, code', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'taskname' => 'имя задания',
            'task' => 'Задание',
            'tip' => 'Подсказка',
            'code' => 'Код',
        );
    }
}