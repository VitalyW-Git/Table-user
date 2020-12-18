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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            // хеш пароля
            $model->password = sha1($model->password);
            $model->created_at = date('Y-m-d H:i:s');
            $model->phone = preg_replace('#[^\d]*#', '', $model->phone);
            $model->save(false);
                return $this->redirect([
                    'view', 'id' => $model->id
                ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
            }
        return $this->render('create');
    }

    /**
     * Updates the existing user model.
     * If the update was successful, the browser will be redirected to the browsing page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel( $id );

        if ($model->load(Yii::$app->request->post())  && $model->validate()) {
            // хешируем пароль
            $model->password = sha1($model->password);
            $model->phone = preg_replace('#[^\d]*#', '', $model->phone);
            $model->save(false);
            return $this->redirect([
                'view', 'id' => $model->id
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        return $this->render('create');
    }

    /**
     * Removes the existing user model.
     * If the deletion was successful, the browser will be redirected to the "index" page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If no model is found, a 404 HTTP exception will be thrown.
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
