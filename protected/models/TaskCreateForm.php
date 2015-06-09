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
            array('task', 'required'),
            array('taskname, task, tip, code', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'taskname' => 'Имя задания',
            'task' => 'Задание',
            'tip' => 'Подсказка',
            'code' => 'Код',
        );
    }
}