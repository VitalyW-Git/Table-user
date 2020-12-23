<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Список всех моделей пользователей.
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        //search( параметры из адресной строки POST запрос );
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Users model.
     * Отображает одну модель пользователей.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new user model.
     * If creation was successful, the browser will be redirected to the browsing page.
     * Создает новую модель пользователей.
     * Если создание прошло успешно, браузер будет перенаправлен на страницу просмотра.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        //загружаем переданные данные POST в объект $model
        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            // хеш пароля
            $model->password = sha1($model->password);
            $model->created_at = date('Y-m-d H:i:s');
            $model->phone = preg_replace('#[^\d]*#', '', $model->phone);
            $model->save(false);
            // при успешном сохранении
                return $this->redirect([
                    'view', 'id' => $model->id
                ]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates the existing user model.
     * If the update was successful, the browser will be redirected to the browsing page.
     * Обновляет существующую модель пользователей.
     * Если обновление прошло успешно, браузер будет перенаправлен на страницу просмотра.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate( $id )
    {
//        $model = Users::findOne(['id' => $id]);
        $model = $this->findModel( $id );
        // передаём POST
        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            // хешируем пароль
            $model->password = sha1($model->password);
            $model->phone = preg_replace('#[^\d]*#', '', $model->phone);
            $model->save(false);
            return $this->redirect([
                'view', 'id' => $model->id
            ]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Removes the existing user model.
     * If the deletion was successful, the browser will be redirected to the "index" page.
     * If the deletion was successful, the browser will be redirected to the "index" page.
     * Удаляет существующую модель пользователей.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        Users::findOne(['id' => $id])->delete();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If no model is found, a 404 HTTP exception will be thrown.
     * Находит модель Users на основе значения ее первичного ключа.
     * Если модель не найдена, будет выдано исключение 404 HTTP.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
