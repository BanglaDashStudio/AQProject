<?php

class TaskCreatorController extends Controller
{
	public function actionIndex($gameId)
	{
		$taskForm = new TaskCreate;

		$taskForm->type = '15-15-15';

		if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-createTaskForm-form')
		{
			echo CActiveForm::validate($taskForm);
			Yii::app()->end();
		}

		$this->render('createTaskForm',array('gameId'=>$gameId, 'createTaskForm'=>$taskForm));
	}


	public function actionCreateTask($gameId)
	{
		$taskForm = new TaskCreate;

		$taskForm->type = '15-15-15';

		if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-createTaskForm-form')
		{
			echo CActiveForm::validate($taskForm);
			Yii::app()->end();
		}

		if(isset($_POST['TaskCreate']))
		{
			$taskForm->name = $_POST['TaskCreate']['name'];
			$taskForm->address = $_POST['TaskCreate']['address'];
			$taskForm->type = $_POST['TaskCreate']['type'];
			$taskForm->description = $_POST['TaskCreate']['description'];
			$taskForm->code = $_POST['TaskCreate']['code'];

			if($taskForm->validate())
			{
				if(null == Task::model()->findAllByAttributes(array('name'=>$taskForm->name,
						'address'=>$taskForm->address)) ){
					$task = new Task();
				} else {
					$task = Task::model()->findByAttributes(array('name'=>$taskForm->name,
						'address'=>$taskForm->address));
				}

				$task->name = $taskForm->name;
				$task->address = $taskForm->address;
				$task->type = $taskForm->type;
				$task->gameId = $gameId;

				if(!isset($task->mediaId)){
					$media = new Media();
				} else {
					$media = Media::model()->findByPk($task->mediaId);
				}

				$media->description = $taskForm->description;

				if($media->save()) {
					$task->mediaId = $media->id;
				} else {
					return;
				}

				if(!$task->save()) {
					Media::model()->deleteByPk($media->id);
					return;
				}

				Code::model()->deleteAllByAttributes(array('taskId'=>$task->id));

				$code = new Code();

				$code->taskId = $task->id;
				$code->code = $taskForm->code;

				if(!$code->save()){
					Media::model()->deleteByPk($media->id);
					Task::model()->deleteByPk($task->id);
					return;
				}

				if(isset($_POST['TaskCreate']['codes'])){
					foreach($_POST['TaskCreate']['codes'] as $item){
						if($item != ''){
							$code = new Code();
							$code->taskId = $task->id;
							$code->code = $item;

							if(null == Code::model()->findByAttributes(array('taskId'=>$code->taskId,
									'code'=>$code->code)))
							{
								if($code->validate()){
									$code->save();
								}
							}
						}
					}
				}

				if(isset($_POST['TaskCreate']['codes'])) {
					$this->render('updateTaskForm', array('taskId'=>$task->id,'mediaId'=>$task->mediaId,'gameId' => $gameId, 'createTaskForm' => $taskForm, 'codes' => $_POST['TaskCreate']['codes']));
				} else {
					$this->render('updateTaskForm', array('taskId'=>$task->id,'mediaId'=>$task->mediaId, 'gameId' => $gameId, 'createTaskForm' => $taskForm));
				}
				return;
			}
		}
		$this->render('createTaskForm',array('gameId'=>$gameId, 'createTaskForm'=>$taskForm));
	}

	public function actionUpdateTask($gameId, $taskId){
		$taskOrigin = Task::model()->findByPk($taskId);
		$taskForm = new TaskCreate;

		$taskForm->type = $taskOrigin->type;
		$taskForm->name = $taskOrigin->name;
		$taskForm->address = $taskOrigin->address;
		$taskForm->description = Media::model()->findByPk($taskOrigin->mediaId)->description;
		$taskForm->code = Code::model()->findAllByAttributes(array('taskId'=>$taskId))[0]->code;

		if(isset($_POST['ajax']) && $_POST['ajax']==='task-create-createTaskForm-form')
		{
			echo CActiveForm::validate($taskForm);
			Yii::app()->end();
		}

		if(isset($_POST['TaskCreate']))
		{
			$taskForm->name = $_POST['TaskCreate']['name'];
			$taskForm->address = $_POST['TaskCreate']['address'];
			$taskForm->type = $_POST['TaskCreate']['type'];
			$taskForm->description = $_POST['TaskCreate']['description'];
			$taskForm->code = $_POST['TaskCreate']['code'];

			if($taskForm->validate())
			{
				if(null == Task::model()->findAllByAttributes(array('name'=>$taskForm->name,
						'address'=>$taskForm->address)) ){
					$task = new Task();
				} else {
					$task = Task::model()->findByAttributes(array('name'=>$taskForm->name,
						'address'=>$taskForm->address));
				}

				$task->name = $taskForm->name;
				$task->address = $taskForm->address;
				$task->type = $taskForm->type;
				$task->gameId = $gameId;

				if(!isset($task->mediaId)){
					$media = new Media();
				} else {
					$media = Media::model()->findByPk($task->mediaId);
				}

				$media->description = $taskForm->description;

				if($media->save()) {
					$task->mediaId = $media->id;
				} else {
					return;
				}

				if(!$task->save()) {
					Media::model()->deleteByPk($media->id);
					return;
				}

				Code::model()->deleteAllByAttributes(array('taskId'=>$task->id));

				$code = new Code();

				$code->taskId = $task->id;
				$code->code = $taskForm->code;

				if(!$code->save()){
					Media::model()->deleteByPk($media->id);
					Task::model()->deleteByPk($task->id);
					return;
				}

				if(isset($_POST['TaskCreate']['codes'])){
					foreach($_POST['TaskCreate']['codes'] as $item){
						if($item != ''){
							$code = new Code();
							$code->taskId = $task->id;
							$code->code = $item;

							if(null == Code::model()->findByAttributes(array('taskId'=>$code->taskId,
									'code'=>$code->code)))
							{
								if($code->validate()){
									$code->save();
								}
							}
						}
					}
				}

				if(isset($_POST['TaskCreate']['codes'])) {
					$this->render('updateTaskForm', array('taskId'=>$task->id,'mediaId'=>$task->mediaId,'gameId' => $gameId, 'createTaskForm' => $taskForm, 'codes' => $_POST['TaskCreate']['codes']));
				} else {
					$this->render('updateTaskForm', array('taskId'=>$task->id,'mediaId'=>$task->mediaId, 'gameId' => $gameId, 'createTaskForm' => $taskForm));
				}
				return;
			}
		}

		$codesArray = Code::model()->findAllByAttributes(array('taskId'=>$taskId));
		if(count($codesArray)>1){
			$codesText[0] = '';
			$i = -1;
			foreach($codesArray as $code){
				if($i>=0) $codesText[$i] = $code->code; //ропускаем первый код, он отдельно.
				$i++;
			}
		}

		$this->render('updateTaskForm',array('gameId'=>$gameId,'taskId'=>$taskId,'mediaId'=>$taskOrigin->mediaId, 'createTaskForm'=>$taskForm, 'codes'=>$codesText));
	}

}