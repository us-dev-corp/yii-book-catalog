<?php

namespace app\controllers;

use app\models\Authors;
use app\models\Subscription;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use Yii;


class AuthorController extends Controller
{

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Displays a single Author model.
     *
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $phone = Yii::$app->request->cookies->getValue('phone');
        if (Yii::$app->user->isGuest && $phone) {
            $subscriptionAvailability = (bool)Subscription::find()->where(['author' => $id])->andWhere(['phone' => $phone])->one();
        } else {
            $subscriptionAvailability = false;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'subscriptionAvailability' => $subscriptionAvailability,
        ]);
    }

    /**
     * Finds the Authors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return Authors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Authors
    {
        if (($model = Authors::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Экшен подписки/отписки от автора
     *
     * @return array
     */
    public function actionSubscribe(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        if (!isset($data['author']) || !isset($data['phone'])) {
            return [
                'success' => false
            ];
        }

        if (!Authors::findOne($data['author'])) {
            return [
                'success' => false
            ];
        }

        $subscribe = Subscription::find()->where(['author' => $data['author']])->andWhere(['phone' => $data['phone']])->one();
        if ($subscribe) {
            $subscribe->delete();
            $message = 'Вы успешно отписались от автора';
            $action = 'unsubscribe';
        } else {
            $subscribe = new Subscription();
            $subscribe->author = $data['author'];
            $subscribe->phone = $data['phone'];
            $subscribe->save();

            $message = 'Вы успешно подписались на автора';
            $action = 'subscribe';
        }

        return [
            'success' => true,
            'message' => $message,
            'action' => $action
        ];
    }

    /**
     * Экшен отчета
     *
     * @return mixed
     */
    public function actionReport()
    {
        $dataProvider = null;

        if (isset(Yii::$app->request->get()['year'])) {
            $year = Yii::$app->request->get()['year'];

            $query = Authors::find()
                ->select(['authors.id', 'authors.name', 'authors.surname', 'authors.patronymic', 'COUNT(books.id) AS book_count'])
                ->joinWith('books')
                ->where(['books.year' => $year])
                ->groupBy('authors.id')
                ->orderBy(['book_count' => SORT_DESC])
                ->limit(10);

            if ($query) {
                $dataProvider = new ActiveDataProvider(
                    [
                        'query' => $query,
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                        'sort' => [
                            'defaultOrder' => [
                                'id' => SORT_ASC,
                            ]
                        ],
                    ]
                );
            }
        }

        return $this->render('report', [
            'dataProvider' => $dataProvider
        ]);
    }
}
