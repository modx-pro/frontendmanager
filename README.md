# FrontendManager

![modx_revo](https://img.shields.io/badge/modx_revo-%232F4150.svg?&style=for-the-badge&logo=modx&logoColor=white)

Панель, отображаемая во фронтенде, для быстрого вызова страниц административной панели modx revo не покидая страницы сайта.

Компонент умеет грузить фрейм админки, добавляя в нее немного css для скрытия ненужных блоков.

## Элементы панели управления

- Редактирование страницы
- Пользователи
- Заказы
- Настройки контекста
- Настройки
- Журнал ошибок
- Очистка кэша

## Настройка

- В системных настройках доступны такие параметры как:
  - `frontendmanager_frontend_position` - отвечает за размещение панели.
  - `frontendmanager_contenttypes` - типы содержимого для вывода панели.
  - `frontendmanager_ignore_resources` - какие ресурсы игнорировать (ID через запятую).
  - `frontendmanager_ignore_templates` - какие шаблоны ресурсов игнорировать (ID через запятую).
  - а также настройки стилей для `manager` и `frontend` части сайта.
- Чанк `tpl.frontendmanager` для вывода панели и ссылок.
- Плагин `frontendmanager` для вставки панели на страницу (доступен естественно залогиненным в админку пользователям).

## Дополнительно

В Iframe можно открывать страницы админки не только из панели FrontendManager, но и любые ссылки. Например, вы можете настроить на бэкенде вывод для администратора ссылок на редактирование у каждой статьи в каталоге статей, и редактировать их прямо из общего списка:

```html
<a href="/manager/?a=resource/update&id=111" onclick="event.preventDefault();frontendManager.open(this.href)">редактировать</a>
```

![модальное окно панели управления frontendManager](https://github.com/alexsoin/modx-frontendmanager/assets/3787132/6f7c3b30-cda5-4d5f-a2a9-f8a719ddbd0b)

![панель управления frontendManager](https://github.com/alexsoin/modx-frontendmanager/assets/3787132/67f78c0a-9dd1-41b0-9464-f736b268a276)

Для перехода в административную панель нажмите на иконку `modx` в панели управления через `скм`, либо через `ctrl+click`:

![иконка modx в панели управления frontendManager](https://github.com/alexsoin/modx-frontendmanager/assets/3787132/615b87dd-226c-4247-a5f6-0d2af37fcbb4)

## Системные требования

- **modx**: >= 2.3 < 3
- **pdoTools**
