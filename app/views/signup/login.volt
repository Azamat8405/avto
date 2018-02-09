{% extends "admin/main.volt" %}

{% block content %}

<?php use Phalcon\Tag; ?>

<h2>Войти</h2>

<?php echo Tag::form("signup/auth"); ?>

<p>
    <label for="name">Логин</label>
    <?php echo Tag::textField("login") ?>
</p>

 <p>
    <label for="name">Пароль</label>
    <?php echo Tag::passwordField("password") ?>
 </p>

 <p>
    <?php echo Tag::submitButton("Войти") ?>
 </p>

</form>

{% endblock %}