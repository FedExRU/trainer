<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ol`.
 */
class m161128_152713_create_ol_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('answers',[
            'question_id' => 1,
            'text' => 'совокупность данных, организованных по определенным правилам;',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 1,
            'text' => 'совокупность программ для хранения и обработки больших массивов информации;',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 1,
            'text' => 'интерфейс, поддерживающий наполнение и манипулирование данными;',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 1,
            'text' => 'определенная совокупность информации.',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 2,
            'text' => 'распределенные базы данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 2,
            'text' => 'иерархические базы данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 2,
            'text' => 'сетевые базы данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 2,
            'text' => 'реляционные базы данных',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 3,
            'text' => 'неупорядоченное множество данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 3,
            'text' => 'вектор',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 3,
            'text' => 'генеалогическое дерево',
            'input_type' => '',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 3,
            'text' => 'двумерная таблица',
            'input_type' => '',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 4,
            'text' => 'модули',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 4,
            'text' => 'таблицы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 4,
            'text' => 'макросы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 4,
            'text' => 'ключи',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 4,
            'text' => 'формы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 4,
            'text' => 'отчеты',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 4,
            'text' => 'запросы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 5,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 5,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 5,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 5,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 5,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 6,
            'text' => 'для вывода обработанных данных базы на принтер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);
        
        $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 7,
            'text' => 'для вывода обработанных данных базы на принтер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 8,
            'text' => 'для вывода обработанных данных базы на принтер',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        ///////
         $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 9,
            'text' => 'для вывода обработанных данных базы на принтер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        ////////////??????????
         $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для хранения данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для отбора и обработки данных базы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для ввода данных базы и их просмотра',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для автоматического выполнения группы команд',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для выполнения сложных программных действий',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 10,
            'text' => 'для вывода обработанных данных базы на принтер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 12,
            'text' => 'в проектировочном',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 12,
            'text' => 'в любительском',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 12,
            'text' => 'в заданном',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 12,
            'text' => 'в эксплуатационном',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 13,
            'text' => 'таблица связей',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 13,
            'text' => 'схема связей',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 13,
            'text' => 'схема данных',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 13,
            'text' => 'таблица данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 14,
            'text' => 'недоработка программы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 14,
            'text' => 'потому что данные сохраняются сразу после ввода в таблицу',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 14,
            'text' => ' потому что данные сохраняются только после закрытия всей базы данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без отчетов',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без таблиц',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без форм',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без макросов',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без запросов',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 15,
            'text' => 'без модулей',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 16,
            'text' => 'в записях',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 16,
            'text' => 'в столбцах',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 16,
            'text' => 'в ячейках',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 16,
            'text' => 'в строках',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 16,
            'text' => 'в полях',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 17,
            'text' => 'таблица без записей существовать не может',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 17,
            'text' => 'пустая таблица не содержит ни какой информации',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 17,
            'text' => 'пустая таблица содержит информацию о структуре базы данных',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 17,
            'text' => 'пустая таблица содержит информацию о будущих записях',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 18,
            'text' => 'содержит информацию о структуре базы данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 18,
            'text' => 'не содержит ни какой информации',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 18,
            'text' => 'таблица без полей существовать не может',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 18,
            'text' => 'содержит информацию о будущих записях',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 19,
            'text' => 'служит для ввода числовых данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 19,
            'text' => 'служит для ввода действительных чисел',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 19,
            'text' => 'данные хранятся не в поле, а в другом месте, а в поле хранится только указатель на то, где расположен текст',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 19,
            'text' => 'имеет ограниченный размер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 19,
            'text' => 'имеет свойство автоматического наращивания',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 20,
            'text' => 'служит для ввода числовых данных',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 20,
            'text' => 'служит для ввода действительных чисел',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 20,
            'text' => 'многострочный текст',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 20,
            'text' => 'имеет ограниченный размер',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 20,
            'text' => 'имеет свойство автоматического наращивания',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 21,
            'text' => 'поле, значения в котором не могут повторятся',
            'input_type' => 'checkbox',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 21,
            'text' => 'поле, которое носит уникальное имя',
            'input_type' => 'checkbox',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 21,
            'text' => 'поле, значение которого имеют свойство наращивания',
            'input_type' => 'checkbox',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 21,
            'text' => 'ключевое поле',
            'input_type' => 'checkbox',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 22,
            'text' => 'логические выражения, определяющие условия поиска',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 22,
            'text' => 'поля, по значению которых осуществляется поиск',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 22,
            'text' => 'номера записей, удовлетворяющих условиям поиска',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 22,
            'text' => 'номер первой по порядку записи, удовлетворяющей условиям поиска',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 22,
            'text' => 'диапазон записей файла БД, в котором осуществляется поиск',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 23,
            'text' => 'уникального программного обеспечения',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 23,
            'text' => 'систем программирования',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 23,
            'text' => 'системного программного обеспечения',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 23,
            'text' => 'прикладного программного обеспечения',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

         $this->insert('answers',[
            'question_id' => 23,
            'text' => 'операционной системы',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 24,
            'text' => 'страница классного журнала',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 24,
            'text' => 'каталог файлов, хранимых на диске',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 24,
            'text' => 'расписание поездов',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 24,
            'text' => 'электронная таблица',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 25,
            'text' => 'неоднородная информация (данные разных типов)',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 25,
            'text' => 'исключительно однородная информация (данные только одного типа)',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 25,
            'text' => 'только текстовая информация',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 25,
            'text' => 'исключительно числовая информация',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 25,
            'text' => 'только логические величины',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 26,
            'text' => 'локальная',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 26,
            'text' => 'файл-серверные',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 26,
            'text' => 'клиент-серверные',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        /////
        $this->insert('answers',[
            'question_id' => 27,
            'text' => 'локальная',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 27,
            'text' => 'файл-серверные',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 27,
            'text' => 'клиент-серверные',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 28,
            'text' => 'локальная',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 28,
            'text' => 'файл-серверные',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 28,
            'text' => 'клиент-серверные',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 29,
            'text' => '*.db',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 29,
            'text' => '*.doc',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 29,
            'text' => '*.xls',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 29,
            'text' => '*.mdb',
            'input_type' => 'radio',
            'is_correct' => true,
            'right_answer' => '',
        ]);

        $this->insert('answers',[
            'question_id' => 29,
            'text' => '*.exe',
            'input_type' => 'radio',
            'is_correct' => false,
            'right_answer' => '',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ol');
    }
}
