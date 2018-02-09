{% extends "admin/main.volt" %}

{% block content %}

<?php use Phalcon\Tag; ?>

<h2>Регистрация</h2>

<?php echo Tag::form("signup/register"); ?>

 <p>
    <label for="name">Логин</label>
    <?php echo Tag::textField("login") ?>
 </p>

 <p>
    <label for="name">Пароль</label>
    <?php echo Tag::passwordField("password") ?>
 </p>

 <p>
    <?php echo Tag::submitButton("Регистрация") ?>
 </p>

</form>

{% endblock %}