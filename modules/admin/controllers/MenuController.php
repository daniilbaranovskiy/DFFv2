<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Image;
use app\modules\admin\models\Menu;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Menu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
            'pagination' => [
                'pageSize' => 10
            ],
            /*
           'sort' => [
               'defaultOrder' => [
                   'id' => SORT_DESC,
               ]
           ],
           */
        ]);
        if (Yii::$app->user->identity->role != 'admin') {
            $message = 'Доступ до даної сторінки можуть мати тільки користувачи з відповідними правами доступу';
            return $this->render('error', compact('message'));
        } else
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->role != 'admin') {
            $message = 'Доступ до даної сторінки можуть мати тільки користувачи з відповідними правами доступу';
            return $this->render('error', compact('message'));
        } else
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image){
                    $model->upload();
                }
                Yii::$app->session->setFlash('success', "Страва {$model->name} успішно додана");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        if (Yii::$app->user->identity->role != 'admin') {
            $message = 'Доступ до даної сторінки можуть мати тільки користувачи з відповідними правами доступу';
            return $this->render('error', compact('message'));
        } else
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image){
                $model->upload();
            }
            Yii::$app->session->setFlash('success', "Страва {$model->name} оновлена");
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (Yii::$app->user->identity->role != 'admin') {
            $message = 'Доступ до даної сторінки можуть мати тільки користувачи з відповідними правами доступу';
            return $this->render('error', compact('message'));
        } else
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->findImage($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Потрібної сторінки не існує!');
    }
    protected function findImage($id)
    {
        if (($model = Image::findOne(['itemId' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Потрібної сторінки не існує!');
    }
}
