<?php
class TaskCreateForm extends CFormModel
{
    public $taskname;
    public $task;
    public $tip;
    public $code;
    public $address;
    public $type;
    private $_identity;

    public function rules()
    {
        return array(
            array('task, taskname', 'required'),
            array('code','numerical', 'integerOnly'=>true),
            array('taskname, task, tip, code, address, type', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'taskname' => 'название задания (для сетки)',
            'task' => 'Задание',
            'tip' => 'Подсказка',
            'code' => 'Код',
            'address' => 'Адрес',
            'type'=>'Тип(не указывать для стандартных заданий ) ',
        );
    }
}