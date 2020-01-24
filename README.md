# Тестовое задание

### База данных

MySQL-дамп таблицы `parser_results` расположен в файле `/database/assessment.sql.tar.gz`. Данная таблица содержит входные данные для вашего тестового задания. Это небольшой фрагмент реальных данных, с которыми вам, возможно, придется столкнуться в работе.

Обратите внимание, что из таблицы **намеренно удалены** все индексы, кроме основного автоинкрементного. Если вы посчитаете необходимым исправить ситуацию, то создайте файл `/database/migrations.sql` и укажите в нем все необходимые запросы.

### Требования к коду

Точка входа вашей программы должна находится в файле `/public/index.php`. Весь PHP-код, отвечающий за бизнес-логику, должен быть сосредоточен в папках `public` и `src`, файлы других типов вы можете располагать по своему усмотрению.

Конфигурация БД и другие необходимые вам настройки должны быть агрегированы в файле `/src/settings.php`. Один из возможных вариантов его организации уже приведен в файле.

Учтите, что в файле `composer.json` указано требование к версии PHP. 

### Суть задачи

Из данных, представленных в таблице `parser_results`, вам необходимо сгенерировать отчет в табличной форме согласно требованиям описанным ниже. При выполнении задания уделите **особое внимание** оптимальности алгоритма с точки зрения скорости выполнения и использования памяти.

**Структура исходных данных**

* `id` - автоинкрементный индекс строки с данными, не играет роли для данной задачи
* `task_id` - идентификатор задания по которому будет запрашиваться отчет
* `model` - модель товара, по которой необходимо проводить группировку результатов
* `input` - входящие данные для сбора данных, не важны для тестового задания
* `result` - сериализованные при помощи встроенной функции `serialize()` данные (поле будет иметь значение `NULL`, если в процессе сбора информации произошла ошибка) 

В поле `result` храниться сериализованный массив данных с информацией о конкретных товарах. Для каждого товара представлены следующие поля:

* `title` - заголовок товара
* `url` - URL товара на eBay
* `price` - цена в евро
* `shipping` - стоимость доставки (может отсутствовать)

**Формат требуемого отчета**

В представленной таблице данные по товарам в рамках модели разбросаны по нескольким записям, а сами товары, хранящиеся в сериализованном виде, могут дублироваться (в этом случае у них будет одинаковый URL). Ваша задача - создать сводную таблицу по данным с `task_id = 106`.

Для каждой модели вам необходимо выбрать 3 уникальных товара с наименьшей суммой цены и стоимости доставки и отобразить для них заголовок, ссылку, цену и стоимость доставки.

Пример результируещей таблицы:
```
Model       | Title           | URL                      | Price  | Shipping
----------------------------------------------------------------------------
CHR-001-001 | Turbo CHRA...   | https://.../173690914902 | 48.17  | 9.83
CHR-001-001 | Turbolader...   | https://.../173690913940 | 48.17  | 9.83
CHR-001-001 | BV39 turbo...   | https://.../232888254864 | 62.10  |
CHR-001-006 | Turbo CHRA...   | https://.../173363389297 | 165.16 | 11.70
CHR-001-006 | Chra garrett... | https://.../261355675870 | 284.12 | 12.68
CHR-001-006 | Chra garrett... | https://.../261355621424 | 284.12 | 12.68
```
