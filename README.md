# Laravel test project

For run server you can use 

### ./vendor/bin/sail up

## Задачи
    Используя фреймворк Laravel реализовать RESTful api.
    
    1. Реализовать сущности:
        > Товары 
        > Категории 
        > Товар-Категория
    2. Реализовать выдачу данных в формате json по RESTful
    3. Создание Товаров (у каждого товара может быть от 2х до 10 категорий)
    4. Редактирование Товаров
    5. Удаление товаров (товар помечается как удаленный)
    6. Создание категорий
    7. Удаление категорий (вернуть ошибку если категория прикреплена к товару)
    8. Получение списка товаров: 
        > Имя / по совпадению с  именем
        > id категории
        > Название категории  / по совпадению с  категорией 
        > Цена от - до
        > Опубликованные да / нет
        > Не удаленные

## Результат представить ссылкой на репозиторий.
    * Важно, в репозиторий залить пустой каркас приложения, а затем с внесенными изменениями, чтобы можно было проследить diff.
    
## Реализованы
1. Модели Product Category Product-Category, а так же созданы миграции для данных таблиц
2. Создан весь необходимый функционал
3. Добавлена фильтрация на получение списка товаров по параметрам, указанным выше.
### (/api/product)

