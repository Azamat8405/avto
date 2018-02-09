{% extends "admin/main.volt" %}

{% block content %}

<?php use Phalcon\Tag; ?>

<h2>Редактирование уведомления</h2>

<?php echo Tag::form("admin/saveMessage"); ?>

<p>
    <label for="name">Заголовок</label>

    <input type="text" name="title" value="{{message.title}}" maxlength="240">
	<input type="hidden" value="{{message.id}}" name="id">
</p>

 <p>
    <label for="name">Текст</label>
    <textarea name="text" cols="30" rows="10">{{message.text}}</textarea>
 </p>

 <p>
    <?php echo Tag::submitButton("Редактировать"); ?>
 </p>

</form>
{% endblock %}