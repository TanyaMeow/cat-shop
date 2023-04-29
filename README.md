# Symfony Docker

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

![CI](https://github.com/dunglas/symfony-docker/workflows/CI/badge.svg)

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Иструкция по работе с Frontend'ом

Исходный код frontend приложения лежит в директории assets. Также там находятся импортируемые стили  
1. `app.js` - точка входа в приложение, не содержит кода, зато импортирует все необходимые части приложения, именно этот файл будет запускаться при открытии страницы
2. `bootstrap.js` - файл в котором конфигурируется react, содержит корневой компонент и код необходимый для запуска react приложения

>Важно, файлы из assets не будут работать сами по себе, для этого необходимо собрать их в единый файл силами webpack и bubble,  
> для этого предусмотрены необходимые команды. Результат сборки храниться по пути public/build, директория public та директория, к которой имеет доступ браузер

Для того, чтобы изменения вступили в силу необходимо выполнить команду `npm run watch`, она запустит сервер который будет прослушивать все изменения и автоматический обновлять public/build

Шаблон в который рендерится react приложение лежит по пути `templates/spa.html.twig`

### Важная информация!
Endpoint на добавление товара описаный в docs/rest.yml содержит тело запроса не являющиеся json'ом.  
Даные необходимо отправлять в формате `multipart/form-data` https://learn.javascript.ru/formdata

## License

Symfony Docker is available under the MIT License.

## Credits

Created by [Kévin Dunglas](https://dunglas.fr), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
