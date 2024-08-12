<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksSearch;
use app\models\AuthorsOfBooks;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\Response;
use Yii;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     *
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Books();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if (isset($this->request->post()['Books']['authors']) && !empty($this->request->post()['Books']['authors'])) {
                    $authors = $this->request->post()['Books']['authors'];
                    foreach ($authors as $author) {
                        $authorOfBook = new AuthorsOfBooks();
                        $authorOfBook->author = $author;
                        $authorOfBook->book = $model->id;
                        $authorOfBook->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if (isset($this->request->post()['Books']['authors']) && !empty($this->request->post()['Books']['authors'])) {
                $authors = $this->request->post()['Books']['authors'];
                foreach ($authors as $author) {
                    $authorOfBook = new AuthorsOfBooks();
                    $authorOfBook->author = $author;
                    $authorOfBook->book = $model->id;
                    $authorOfBook->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Books
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
