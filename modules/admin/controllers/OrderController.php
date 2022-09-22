<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Order;
use app\modules\admin\models\OrderItems;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AppAdminController
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
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
     * Displays a single Order model.
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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (Yii::$app->user->identity->role != 'admin') {
            $message = 'Доступ до даної сторінки можуть мати тільки користувачи з відповідними правами доступу!';
            return $this->render('error', compact('message'));
        } else
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\StaleObjectException
     */

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        OrderItems::deleteAll(['order_id' => $id]);
        return $this->redirect(['index']);

    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Потрібної сторінки не існує!');
    }
}
