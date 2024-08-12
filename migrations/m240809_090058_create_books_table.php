<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m240809_090058_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'year' => $this->integer()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(128)->notNull(),
            'photo' => $this->text(),
        ], $tableOptions);

        $this->insert('books', [
            'title' => 'Колесо Времени. Книга 13: Башни Полуночи',
            'year' => '2010',
            'description' => 'Мир на грани Последней битвы. Знамения, явленные глазам людей, странности, происходящие повсеместно, — все говорит о том, что совсем недалек тот день, когда Ранду ал’Тору, Дракону Возрожденному, предстоит напрямую сразиться с Темным, рвущимся из своего узилища в Шайол Гул. На Пограничные земли уже обрушились орды троллоков — злобных тварей, ударных отрядов Темного. Троллоков ведут мурддраалы, их командиры, рядом с ними Повелители ужаса, те, кто выбрал сторону Тьмы, — люди, способные направлять Силу. Пали дозорные крепости, города и селения Порубежья находятся под ударом. Едва не пала столица Салдэйи. В Белой Башне орудуют таинственные убийцы… Ранд, в тревоге за будущее планеты, отправляет армии верных ему союзников на Поле Меррилор — там, судя по всем приметам, и произойдет Последняя битва… Впервые на русском!',
            'isbn' => '978-5-389-22958-7',
            'photo' => 'https://content.img-gorod.ru/pim/products/images/a5/a3/018f85b9-01a3-7ba0-a8d7-be304a30a5a3.jpg',
        ]);

        $this->insert('books', [
            'title' => 'Мертвые души',
            'year' => '1852',
            'description' => 'Поэма "Мертвые души" еще при жизни автора была переведена на множество других языков. Она имела невероятный успех. Никому до Гоголя и после него не удавалось так ярко и остро описать пороки и слабости русского человека, так живо и правдиво отразить важнейшие для России проблемы. Прошло 160 лет, и поэма звучит как только что написанная. Чичиковы, Коробочки, Ноздревы, Плюшкины, Собакевичи — их стремления, чувства, поступки не кажутся нам отголосками прошлого. Современное и острое звучание эти персонажи обретают, когда мы смотрим все новые и новые спектакли и фильмы по этой бессмертной поэме.',
            'isbn' => '978-5-17-087889-5',
            'photo' => 'https://content.img-gorod.ru/pim/products/images/e4/30/018fa154-7918-7744-a5b4-dedafcb3e430.jpg',
        ]);

        $this->insert('books', [
            'title' => 'Идеальный программист. Как стать профессионалом разработки ПО',
            'year' => '2016',
            'description' => 'Легендарный эксперт Роберт Мартин, автор бестселлера "Чистый код", рассказывает о том, что значит "быть профессиональным программистом", описывая методы, инструменты и практики разработки "идеального ПО". Книга насыщена практическими советами в отношении всех аспектов программирования: от оценки проекта и написания кода до рефакторинга и тестирования.',
            'isbn' => '978-5-4461-1067-4',
            'photo' => 'https://content.img-gorod.ru/pim/products/images/36/29/0190786b-1466-7fc6-a6e5-39a396f43629.jpg',
        ]);

        $this->insert('books', [
            'title' => 'Десять негритят',
            'year' => '1939',
            'description' => 'Роман «Десять негритят» — один из величайших детективных произведений в истории. Выпущенный общим тиражом более 100 000 000 экземпляров, он занимает пятое место в списке бестселлеров художественной литературы всех времен — и безусловное первое место среди романов самой Агаты Кристи. Агата Кристи — самый публикуемый автор всех времен и народов после Шекспира. Тиражи ее книг уступают только тиражам его произведений и Библии. В мире продано больше миллиарда книг Кристи на английском языке и столько же — на других языках. Она автор восьмидесяти детективных романов и сборников рассказов, двадцати пьес, двух книг воспоминаний и шести психологических романов, написанных под псевдонимом Мэри Уэстмакотт. Ее персонажи Эркюль Пуаро и мисс Марпл навсегда стали образцовыми героями остросюжетного жанра',
            'isbn' => '978-5-04-103497-9',
            'photo' => 'https://content.img-gorod.ru/pim/products/images/0c/08/018f5e1e-c8e7-7b42-887a-c4bead940c08.jpg',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
