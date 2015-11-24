<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_112942_dump_data extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
            (1, 'Дмитрий', 'Глуховский'),
            (2, 'Элайза', 'Грэнвилл'),
            (3, 'Жауме', 'Кабре'),
            (4, 'Сесилия', 'Ахерн'),
            (5, 'Ирвинг ', 'Стоун');
        ");

        $this->execute("
            INSERT INTO `books` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
    (1, '    Метро 2035', '2015-11-24 11:22:36', '2015-11-24 11:23:42', 'Dmitrij_Gluhovskij__Metro_2035.jpeg', '2014-10-10', 1),
    (2, 'Гретель и тьма', '2015-11-24 11:24:45', '2015-11-24 11:24:45', 'Elajza_Grenvill__Gretel_i_tma.jpeg', '2014-05-23', 2),
    (3, 'Я исповедуюсь', '2015-11-24 11:25:15', '2015-11-24 11:25:15', 'Zhaume_Kabre__Ya_ispoveduyus.jpeg', '2012-07-12', 3),
    (4, 'Год, когда мы встретились', '2015-11-24 11:25:44', '2015-11-24 11:25:44', 'Sesiliya_Ahern__God_kogda_my_vstretilis.jpeg', '2010-01-05', 4),
    (5, 'Жажда жизни', '2015-11-24 11:26:06', '2015-11-24 11:26:06', 'Irving_Stoun__Zhazhda_zhizni.jpeg',
    '2010-05-20', 5);"
        );
    }

    public function down()
    {
        echo "m151124_112942_dump_data cannot be reverted.\n";

        $this->execute("TRUNCATE authors");
        $this->execute("TRUNCATE books");

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
