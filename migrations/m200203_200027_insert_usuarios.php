<?php

use yii\db\Migration;

/**
 * Class m200203_200027_insert_usuarios
 */
class m200203_200027_insert_usuarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('usuarios', [
            'alias' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(60),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('usuarios', ['alias' => 'admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_200027_insert_usuarios cannot be reverted.\n";

        return false;
    }
    */
}
