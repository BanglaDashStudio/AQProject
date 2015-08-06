<?php

class TaskCreatorController extends Controller
{
	//0
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

	//1
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

	//2
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

	public function actionUploadImage($mediaId, $gameId, $taskId) {

		if(isset($_FILES['uploadImage'])){
			$uploaddir = 'data/images/';
			$uploadfile = $uploaddir . $_FILES['uploadImage']['name'];

			if(is_uploaded_file($_FILES["uploadImage"]["tmp_name"])) {
				if (move_uploaded_file(($_FILES['uploadImage']['tmp_name']), $uploadfile)) {
					$link = $uploadfile;

					$media = Media::model()->findByPk($mediaId);
					if($media == null) {
						echo 'Невозможно прикрепить изображение к заданию';
						return;
					}
					$media->image = $link;

					if(!$media->save()){
						echo 'Ошибка добавления ссылки в бд';
						return;
					} else {
						$this->render('uploadImage',array('mediaId'=>$mediaId));
					}
				}else {
					echo "Ошибка перемещения изображения!\n";
					return;
				}
			} else {
				echo "Ошибка загрузки изображения!\n";
				return;
			}
		} else {
			$this->render('uploadImage',array('mediaId'=>$mediaId,'gameId'=>$gameId, 'taskId'=>$taskId));
		}
	}

	public function actionUploadAudio($mediaId, $gameId, $taskId) {

		if(isset($_FILES['uploadAudio'])){
			$uploaddir = 'data/audio/';
			$uploadfile = $uploaddir . $_FILES['uploadAudio']['name'];

			if(is_uploaded_file($_FILES["uploadAudio"]["tmp_name"])) {
				if (move_uploaded_file(($_FILES['uploadAudio']['tmp_name']), $uploadfile)) {
					$link = $uploadfile;

					$media = Media::model()->findByPk($mediaId);
					if($media == null) {
						echo 'Невозможно прикрепить звук к заданию';
						return;
					}
					$media->audio = $link;

					if(!$media->save()){
						echo 'Ошибка добавления ссылки в бд';
						return;
					} else {
						$this->render('uploadAudio',array('mediaId'=>$mediaId));
					}
				}else {
					echo "Ошибка перемещения аудио!\n";
					return;
				}
			} else {
				echo "Ошибка загрузки аудио!\n";
				return;
			}
		} else {
			$this->render('uploadAudio',array('mediaId'=>$mediaId,'gameId'=>$gameId, 'taskId'=>$taskId));
		}
	}

}