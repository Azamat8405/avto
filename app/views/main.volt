<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  	<script src="/js/script.js"></script>
  	<script src="/js/jquery.cookie.js"></script>
	<link rel="stylesheet" href="/css/st.css">  	
</head>
<body>

	{% block content %}
	{% endblock %}

	<div id="messages"></div>
</body>
</html>