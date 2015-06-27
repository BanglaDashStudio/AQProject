<?php
class TaskCreateForm extends CFormModel
{
    public $taskname;
    public $task;
    public $tip;
    public $address;
    public $type;

    public function rules()
    {
        return array(
            array('task, taskname', 'required'),
            array('taskname, task, tip, address, type', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'taskname' => 'название задания (для сетки)',
            'task' => 'Задание',
            'tip' => 'Подсказка',
            'address' => 'Адрес',
            'type'=>'Тип(не указывать для стандартных заданий ) ',
        );
    }
}