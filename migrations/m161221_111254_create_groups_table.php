<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m161221_111254_create_groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('groups', [
            'group_number' => '1221',
            'cath_id' => '3',
        ]);

        $this->insert('groups', [
            'group_number' => '1222',
            'cath_id' => '3',
        ]);

        $this->insert('groups', [
            'group_number' => '2221',
            'cath_id' => '3',
        ]);

        $this->insert('groups', [
            'group_number' => '2222',
            'cath_id' => '3',
        ]);

        $this->insert('groups', [
            'group_number' => '3221',
            'cath_id' => '3',
        ]);

        $this->insert('groups', [
            'group_number' => '4221',
            'cath_id' => '3',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('groups');
    }
}
