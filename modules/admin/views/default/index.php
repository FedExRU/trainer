<?php 
  use yii\helpers\ModalWindow;
  
  if($creation != null)
    ModalWindow::createWindow();
?>

<div class="container-center-heading">
    <h2>Главное меню администратора</h2>
    <h3>Сервисы приложения</h3>
</div>

<?php $this->title = 'ГУД | Главная'; ?>

<div class="servises">

    <section class="servise" id="new-subject-servise">
        <div class="service-icon" id="new-subj"></div>
        <article class="servise-description">
           <h3>Добавить новый предмет</h3>
           <h4>Добавьте новое наименование дисциплины к существующим предметам</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="/admin/subjects/create" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="new-mentor-servise">
        <div class="service-icon" id="new-mentor"></div>
        <article class="servise-description">
           <h3>Зарегистрировать преподавателя</h3>
           <h4>Зарегистрируйте нового пользователя с правами преподавателя</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

     <section class="servise" id="new-mentor-subject-servise">
        <div class="service-icon" id="new-mentor-subject"></div>
        <article class="servise-description">
           <h3>Назначить предмет преподавателю </h3>
           <h4>Назначте соответствующему преподавателю необходимую дисциплину</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="new-group-servise">
        <div class="service-icon" id="new-group"></div>
        <article class="servise-description">
           <h3>Добавить новую группу </h3>
           <h4>Добавьте новый номер группы и присвойте ее соответствующему направлению</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="new-group-subject-servise">
        <div class="service-icon" id="new-group-subject"></div>
        <article class="servise-description">
           <h3>Назначить предмет группе </h3>
           <h4>Назначьте соответствующим группам необходимые дисциплины</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="update-group-servise">
        <div class="service-icon" id="update-group"></div>
        <article class="servise-description">
           <h3>Перевести группу</h3>
           <h4>Переведите группу на следующий курс и присвойте ей новый номер</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="new-cathedra-servise">
        <div class="service-icon" id="new-cathedra"></div>
        <article class="servise-description">
           <h3>Открыть новое направление</h3>
           <h4>Зарегистрируйте в Системе новое направление и назначте его факультету</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

    <section class="servise" id="access-recover-servise">
        <div class="service-icon" id="access-recover"></div>
        <article class="servise-description">
           <h3>Восстановить доступ</h3>
           <h4>Восстановите авторизационные данные пользователя</h4>
           <div class="servise-actions">
                <a href="" id="left">О сервисе</a>
                <a href="" id="right">Подробнее</a>
            </div>
        </article>
    </section>

</div>