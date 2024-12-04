<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCatalog;

class SubCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Джоггеры',
                'category_id'=>'1'
            ],
            [
                'name'=>'Зауженные брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Карго',
                'category_id'=>'1'
            ],
            [
                'name'=>'Классические брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Повседневные брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Прямые брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Спортивные брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Тайсы',
                'category_id'=>'1'
            ],
            [
                'name'=>'Утепленные брюки',
                'category_id'=>'1'
            ],
            [
                'name'=>'Чиносы',
                'category_id'=>'1'
            ],


            [
                'name'=>'Анорак',
                'category_id'=>'2'
            ],
            [
                'name'=>'Бомберы',
                'category_id'=>'2'
            ],
            [
                'name'=>'Горнолыжная одежда',
                'category_id'=>'2'
            ],
            [
                'name'=>'Демисезонные куртки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Джинсовые куртки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Жилеты',
                'category_id'=>'2'
            ],
            [
                'name'=>'Кожанные куртки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Легкие куртки и ветровки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Пальто',
                'category_id'=>'2'
            ],
            [
                'name'=>'Парки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Плащи',
                'category_id'=>'2'
            ],
            [
                'name'=>'Пуховики и зимние куртки',
                'category_id'=>'2'
            ],
            [
                'name'=>'Шубы и дубленки',
                'category_id'=>'2'
            ],


            [
                'name'=>'Водолазки',
                'category_id'=>'3'
            ],
            [
                'name'=>'Джемперы и пуловеры',
                'category_id'=>'3'
            ],
            [
                'name'=>'Жилеты',
                'category_id'=>'3'
            ],
            [
                'name'=>'Кардиганы',
                'category_id'=>'3'
            ],
            [
                'name'=>'Свитера',
                'category_id'=>'3'
            ],


            [
                'name'=>'Зауженные джинсы',
                'category_id'=>'4'
            ],
            [
                'name'=>'Карго',
                'category_id'=>'4'
            ],
            [
                'name'=>'Прямые джинсы',
                'category_id'=>'4'
            ],


            [
                'name'=>'Брюки и шорты',
                'category_id'=>'5'
            ],
            [
                'name'=>'Комплекты',
                'category_id'=>'5'
            ],
            [
                'name'=>'Пижамы',
                'category_id'=>'5'
            ],
            [
                'name'=>'Футболки и майки',
                'category_id'=>'5'
            ],
            [
                'name'=>'Халаты',
                'category_id'=>'5'
            ],


            [
                'name'=>'Майки',
                'category_id'=>'7'
            ],
            [
                'name'=>'Спортивные майки',
                'category_id'=>'7'
            ],


            [
                'name'=>'Кальсоны',
                'category_id'=>'8'
            ],
            [
                'name'=>'Майки',
                'category_id'=>'8'
            ],
            [
                'name'=>'Трусы',
                'category_id'=>'8'
            ],
            [
                'name'=>'Футболки',
                'category_id'=>'8'
            ],


            [
                'name'=>'Гетры',
                'category_id'=>'9'
            ],
            [
                'name'=>'Короткие носки',
                'category_id'=>'9'
            ],
            [
                'name'=>'Носки',
                'category_id'=>'9'
            ],


            [
                'name'=>'Брюки',
                'category_id'=>'10'
            ],
            [
                'name'=>'Верхняя одежда',
                'category_id'=>'10'
            ],
            [
                'name'=>'Джемперы, свитеры и кардиганы',
                'category_id'=>'10'
            ],
            [
                'name'=>'Джинсы',
                'category_id'=>'10'
            ],
            [
                'name'=>'Домашняя одежда',
                'category_id'=>'10'
            ],
            [
                'name'=>'Майки',
                'category_id'=>'10'
            ],
            [
                'name'=>'Нижнее белье',
                'category_id'=>'10'
            ],
            [
                'name'=>'Пиджаки и костюмы',
                'category_id'=>'10'
            ],
            [
                'name'=>'Плавки и шорты для плавания',
                'category_id'=>'10'
            ],
            [
                'name'=>'Рубашки',
                'category_id'=>'10'
            ],
            [
                'name'=>'Спортивные костюмы',
                'category_id'=>'10'
            ],
            [
                'name'=>'Термобелье',
                'category_id'=>'10'
            ],
            [
                'name'=>'Толстовки и олимпийки',
                'category_id'=>'10'
            ],
            [
                'name'=>'Футболки и поло',
                'category_id'=>'10'
            ],
            [
                'name'=>'Шорты',
                'category_id'=>'10'
            ],


            [
                'name'=>'Жилеты',
                'category_id'=>'11'
            ],
            [
                'name'=>'Костюмы',
                'category_id'=>'11'
            ],
            [
                'name'=>'Пиджаки',
                'category_id'=>'11'
            ],


            [
                'name'=>'Плавки',
                'category_id'=>'12'
            ],
            [
                'name'=>'Шорты для плавания',
                'category_id'=>'12'
            ],


            [
                'name'=>'Джинсовые рубашки',
                'category_id'=>'13'
            ],
            [
                'name'=>'Рубашки с длинным рукавом',
                'category_id'=>'13'
            ],
            [
                'name'=>'Рубашки с коротким рукавом',
                'category_id'=>'13'
            ],



            [
                'name'=>'Верх',
                'category_id'=>'15'
            ],
            [
                'name'=>'Комплекты',
                'category_id'=>'15'
            ],
            [
                'name'=>'Низ',
                'category_id'=>'15'
            ],


            [
                'name'=>'Комплекты',
                'category_id'=>'16'
            ],
            [
                'name'=>'Лонгсливы',
                'category_id'=>'16'
            ],
            [
                'name'=>'Поло',
                'category_id'=>'16'
            ],
            [
                'name'=>'Спортивные футболки и лонгсливы',
                'category_id'=>'16'
            ],

            [
                'name'=>'Футболки с коротким рукавом',
                'category_id'=>'16'
            ],


            [
                'name'=>'Олимпийки',
                'category_id'=>'17'
            ],
            [
                'name'=>'Свитшоты',
                'category_id'=>'17'
            ],
            [
                'name'=>'Толстовки',
                'category_id'=>'17'
            ],
            [
                'name'=>'Флис',
                'category_id'=>'17'
            ],
            [
                'name'=>'Худи',
                'category_id'=>'17'
            ],

            [
                'name'=>'Бриджи',
                'category_id'=>'18'
            ],
            [
                'name'=>'Джинсовые шорты',
                'category_id'=>'18'
            ],
            [
                'name'=>'Карго',
                'category_id'=>'18'
            ],
            [
                'name'=>'Повседневные шорты',
                'category_id'=>'18'
            ],
            [
                'name'=>'Спортивные шорты',
                'category_id'=>'18'
            ],


            [
                'name'=>'Высокие ботинки',
                'category_id'=>'19'
            ],
            [
                'name'=>'Дезерты',
                'category_id'=>'19'
            ],
            [
                'name'=>'Мартинсы',
                'category_id'=>'19'
            ],
            [
                'name'=>'Низкие ботинки',
                'category_id'=>'19'
            ],
            [
                'name'=>'Тимберленды',
                'category_id'=>'19'
            ],
            [
                'name'=>'Трекинговые ботинки',
                'category_id'=>'19'
            ],
            [
                'name'=>'Челси',
                'category_id'=>'19'
            ],


            [
                'name'=>'Бутсы',
                'category_id'=>'21'
            ],
            [
                'name'=>'Кеды',
                'category_id'=>'21'
            ],
            [
                'name'=>'Кроссовки',
                'category_id'=>'21'
            ],


            [
                'name'=>'Мокасины',
                'category_id'=>'22'
            ],
            [
                'name'=>'Топсайдеры',
                'category_id'=>'22'
            ],



            [
                'name'=>'Акваобувь',
                'category_id'=>'23'
            ],
            [
                'name'=>'Галоши',
                'category_id'=>'23'
            ],
            [
                'name'=>'Джиббитсы',
                'category_id'=>'23'
            ],
            [
                'name'=>'Сабо',
                'category_id'=>'23'
            ],
            [
                'name'=>'Сандали',
                'category_id'=>'23'
            ],
            [
                'name'=>'Сапоги',
                'category_id'=>'23'
            ],
            [
                'name'=>'Сланцы',
                'category_id'=>'23'
            ],


            [
                'name'=>'Валенки',
                'category_id'=>'26'
            ],
            [
                'name'=>'Дутики и луноходы',
                'category_id'=>'26'
            ],
            [
                'name'=>'Сапоги',
                'category_id'=>'26'
            ],
            [
                'name'=>'Угги и унты',
                'category_id'=>'26'
            ],


            [
                'name'=>'Дерби',
                'category_id'=>'28'
            ],
            [
                'name'=>'Лоферы',
                'category_id'=>'28'
            ],
            [
                'name'=>'Монки',
                'category_id'=>'28'
            ],
            [
                'name'=>'Оксфорды',
                'category_id'=>'28'
            ],



            [
                'name'=>'Бабочки',
                'category_id'=>'30'
            ],
            [
                'name'=>'Галстуки',
                'category_id'=>'30'
            ],
            [
                'name'=>'Запонки',
                'category_id'=>'30'
            ],
            [
                'name'=>'Нагрудные платки',
                'category_id'=>'30'
            ],


            [
                'name'=>'Балаклавы',
                'category_id'=>'31'
            ],
            [
                'name'=>'Бейсболки',
                'category_id'=>'31'
            ],
            [
                'name'=>'Кепки',
                'category_id'=>'31'
            ],
            [
                'name'=>'Комплекты',
                'category_id'=>'31'
            ],
            [
                'name'=>'Панама',
                'category_id'=>'31'
            ],
            [
                'name'=>'Повязки',
                'category_id'=>'31'
            ],
            [
                'name'=>'Шапка',
                'category_id'=>'31'
            ],
            [
                'name'=>'Шляпы',
                'category_id'=>'31'
            ],


            [
                'name'=>'Оправы',
                'category_id'=>'34'
            ],
            [
                'name'=>'Солнцезащитные очки',
                'category_id'=>'34'
            ],
            [
                'name'=>'Футляры для очков',
                'category_id'=>'34'
            ],


            [
                'name'=>'Варежки',
                'category_id'=>'35'
            ],
            [
                'name'=>'Перчатки',
                'category_id'=>'35'
            ],
            [
                'name'=>'Спортивные перчатки',
                'category_id'=>'35'
            ],


            [
                'name'=>'Мешки',
                'category_id'=>'37'
            ],
            [
                'name'=>'Рюкзаки',
                'category_id'=>'37'
            ],


            [
                'name'=>'Несессеры',
                'category_id'=>'38'
            ],
            [
                'name'=>'Папки',
                'category_id'=>'38'
            ],
            [
                'name'=>'Поясные сумки',
                'category_id'=>'38'
            ],
            [
                'name'=>'Спортивные сумки',
                'category_id'=>'38'
            ],
            [
                'name'=>'Сумки и чехлы для ноутбуков',
                'category_id'=>'38'
            ],
            [
                'name'=>'Сумки с ручками',
                'category_id'=>'38'
            ],
            [
                'name'=>'Сумки через плечо',
                'category_id'=>'38'
            ],


            [
                'name'=>'Браслеты',
                'category_id'=>'39'
            ],
            [
                'name'=>'Брелоки',
                'category_id'=>'39'
            ],
            [
                'name'=>'Кольца и перстни',
                'category_id'=>'39'
            ],
            [
                'name'=>'Цепи и подвески',
                'category_id'=>'39'
            ],


            [
                'name'=>'Платки',
                'category_id'=>'40'
            ],
            [
                'name'=>'Снуды',
                'category_id'=>'40'
            ],
            [
                'name'=>'Шарфы',
                'category_id'=>'40'
            ],


            [
                'name'=>'Блузки',
                'category_id'=>'41'
            ],
            [
                'name'=>'Рубашки',
                'category_id'=>'41'
            ],


            [
                'name'=>'Боди с длинным рукавом',
                'category_id'=>'42'
            ],
            [
                'name'=>'Боди с коротким рукавом',
                'category_id'=>'42'
            ],


            [
                'name'=>'Бриджи и капри',
                'category_id'=>'43'
            ],
            [
                'name'=>'Джоггеры',
                'category_id'=>'43'
            ],
            [
                'name'=>'Карго',
                'category_id'=>'43'
            ],
            [
                'name'=>'Классические брюки',
                'category_id'=>'43'
            ],
            [
                'name'=>'Кожаные брюки',
                'category_id'=>'43'
            ],
            [
                'name'=>'Кюлоты',
                'category_id'=>'43'
            ],
            [
                'name'=>'Леггинсы',
                'category_id'=>'43'
            ],
            [
                'name'=>'Повседневные брюки',
                'category_id'=>'43'
            ],
            [
                'name'=>'Спортивные брюки',
                'category_id'=>'43'
            ],
            [
                'name'=>'Тайтсы',
                'category_id'=>'43'
            ],
            [
                'name'=>'Утепленные брюки',
                'category_id'=>'43'
            ],


            [
                'name'=>'Анорак',
                'category_id'=>'44'
            ],
            [
                'name'=>'Бомберы',
                'category_id'=>'44'
            ],
            [
                'name'=>'Горнолыжная одежда',
                'category_id'=>'44'
            ],
            [
                'name'=>'Демисезонные куртки',
                'category_id'=>'44'
            ],
            [
                'name'=>'Джинсовые куртки',
                'category_id'=>'44'
            ],
            [
                'name'=>'Жилеты',
                'category_id'=>'44'
            ],
            [
                'name'=>'Кожанные куртки',
                'category_id'=>'44'
            ],
            [
                'name'=>'Легкие куртки и ветровки',
                'category_id'=>'44'
            ],
            [
                'name'=>'Пальто',
                'category_id'=>'44'
            ],
            [
                'name'=>'Парки',
                'category_id'=>'44'
            ],
            [
                'name'=>'Плащи и тренчи',
                'category_id'=>'44'
            ],
            [
                'name'=>'Пончо и кейпы',
                'category_id'=>'44'
            ],
            [
                'name'=>'Утепленные костюмы и комбинезоны',
                'category_id'=>'44'
            ],
            [
                'name'=>'Шубы и дубленки',
                'category_id'=>'44'
            ],




        ];

        SubCatalog::insert($inits);
    }
}
