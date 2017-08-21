<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m161221_112148_create_groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Лингвистика',
            'short_name' => '',
        ]);

        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Психология',
            'short_name' => '',
        ]);

        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Реклама и связи с общественностью',
            'short_name' => 'РСО',
        ]);

        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Социология',
            'short_name' => '',
        ]);

        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Юриспруденция',
            'short_name' => '',
        ]);

        $this->insert('cathedras', [
            'fac_id' => '4',
            'name' => 'Клиническая психология',
            'short_name' => '',
        ]);
    }

    public function down()
    {
        $this->dropTable('groups');
    }
}
