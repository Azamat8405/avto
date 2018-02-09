{% extends "admin/main.volt" %}

{% block content %}

<?php use Phalcon\Tag; ?>

<h2>Добавить уведомление</h2>

<?php echo Tag::form("admin/saveMessage"); ?>

<p>
    <label for="name">Заголовок</label>
    <?php echo Tag::textField(["title", 'maxlength' => 240]) ?>
</p>

 <p>
    <label for="name">Текст</label>
    <?php echo Tag::textArea("text"); ?>
 </p>

 <p>
    <?php echo Tag::submitButton("Добавить"); ?>
 </p>

</form>
{% endblock %}