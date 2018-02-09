<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/css/st.css">
</head>
<body>

	<ul class="menu">
		<li><a href="/admin/listMessages/">Список уведомлений</a></li>
		<li><a href="/admin/addMessage/">Добавить</a></li>
	</ul>

	{% block content %}
	{% endblock %}
	
</body>
</html>