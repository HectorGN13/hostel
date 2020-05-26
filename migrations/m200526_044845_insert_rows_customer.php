<?php

use yii\db\Migration;

/**
 * Class m200526_044845_insert_rows_customer
 */
class m200526_044845_insert_rows_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%customer}}', ['name', 'surname', 'phone_number', 'email'], [
           ['Tyler', 'Durden', '+33 2324 2567', 'tylerdurden@gmail.com'],
           ['Maria', 'Magdalena', '+35 23245 23245', 'maria.mag@gmail.com'],
           ['Hector', 'Garcia', '+34 617 25 67 09', 'gn.hector@gmail.com'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200526_044845_insert_rows_customer cannot be reverted.\n";
        $this->delete('{{%customer}}', ['email' => 'tylerdurden@gmail.com']);
        $this->delete('{{%customer}}', ['email' => 'maria.mag@gmail.com']);
        $this->delete('{{%customer}}', ['email' => 'gn.hector@gmail.com']);
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200526_044845_insert_rows_customer cannot be reverted.\n";

        return false;
    }
    */
}
