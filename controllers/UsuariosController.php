<?php

namespace app\controllers;

use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\bootstrap4\Alert;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['registrar', 'update'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'actions' => ['registrar'],
                        'roles' => ['?'],
                    ],
                    // everything else is denied by default
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionRegistrar()
    {
        $model = new Usuarios(['scenario' => Usuarios::SCENARIO_CREAR]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha creado el usuario correctamente.');
            return $this->redirect(['site/login']);
        }

        return $this->render('registrar', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null)
    {
        if ($id === null) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', 'Debe estar logueado.');
                //return $this->goHome();
                //Ejercicio 1b
                return $this->redirect(['site/login']);
            } else {
                $model = Yii::$app->user->identity;
            }
        } else {
            //ejercicio 1b
            if ($id === Yii::$app->user->id) {
                $model = Usuarios::findOne($id);
            } else {
                Yii::$app->session->setFlash('error', 'No puedes modificar a otro usuario.');
                return $this->goBack();
            }
        }

        $model->scenario = Usuarios::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha modificado correctamente.');
            return $this->goHome();
        }

        $model->password = '';
        $model->password_repeat = '';
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
