<?php
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $user
 */

use webvimark\modules\UserManagement\models\rbacDB\Role;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
use yii\helpers\Html;
use yii\rbac\DbManager;

$this->title = 'Права для пользователя: ' . $user->username;

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/user-management/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span> Роли
				</strong>
			</div>
			<div class="panel-body">

				<?= Html::beginForm(['set-roles', 'id'=>$user->id]) ?>

				<?= Html::checkboxList(
					'roles',
					ArrayHelper::map(Role::getUserRoles($user->id), 'name', 'name'),
					ArrayHelper::map((new DbManager())->getRoles(), 'name', 'name'),
					['separator'=>'<br>']
				) ?>
				<br/>

				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> Сохранить',
					['class'=>'btn btn-primary btn-sm']
				) ?>

				<?= Html::endForm() ?>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span> Права
				</strong>
			</div>
			<div class="panel-body">

				<ul>
					<?php foreach (Permission::getUserPermissions($user->id) as $permission): ?>
						<li><?= $permission->description ?></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>