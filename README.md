### JS task
```
// Нужно написать Jquery-плагин:
// По клику на кнопку сделать запрос по переданному аргументом url, получить json данные (см. ниже)
// И отобразить их в виде таблицы внутри Bootstrap modal-окна, при этом изменив формат даты на "d.m.Y"

{
    "items": [
        {
            "id" : 1,
            "date" : "2016-02-18",
            "title" : "Item 1"
        },
        {
            "id" : 2,
            "date" : "2016-02-16",
            "title" : "Item 2"
        },
        {
            "id" : 3,
            "date" : "2016-01-10",
            "title" : "Item 3"
        }
    ]
}
```

### PHP task
```
<?php
//Реализовать интерфейс:
interface ChangelogInterface
{
    public function getCurrentTag(); // Получить последнюю по дате версию
    public function getChangelog(); // Получить многомерный ассоц. массив для передачи в шаблонизатор, при этом изменив формат даты на d.m.Y
}
/* Для обработки файла вида:
<?xml version="1.0" encoding="utf-8"?>
<changelog>
    <release tag="0.1.0" date="2016-02-18">
        <update>Feature 1</update>
        <update>Feature 2</update>
        <update>Feature 3</update>
    </release>
    <release tag="0.0.0" date="2016-02-11">
        <update>Core</update>
    </release>
    <release tag="0.0.1" date="2016-02-14">
        <update>Core fix</update>
    </release>
</changelog> */
```