# Гайд для контрибьюторов

Процесс пулл реквеста
---------------------

- делаем форк проекта
- клоним оригнальный репозиторий
- добавляем себе ссылку на свой репозиторий `git remote add myfork %url%`
- создаем новую ветку, название ветки это слово issue-24, где 24 это номер ишью.
- пишем код
- коммитим в формате 'ISSUE-24: How to fix'
- `git push myfork <branchName>`
- создаем пул реквест в мастер
- проверяем и заполняем форму пулреквеста
- если есть конфликт - делаем `git pull origin master`, разрешаем конфликт
- проверяем, есть ли проблемы с кодклиматом, если да - фиксим по максимуму
- ждем код ревью
- фиксим правки по ревью
