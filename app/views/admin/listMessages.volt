{% extends "admin/main.volt" %}

{% block content %}

	{% if messagesList %}

		<ul>
		{% for el in messagesList  %}

			<li>
				<a href="">{{el.title}}</a>
				{{el.getDate()}} 
				<a href="/admin/deleteMessage?id={{el.id}}">удалить</a>
				<a href="/admin/editMessage?id={{el.id}}">редактировать</a>
			</li>

		{% endfor %}
		</ul>
	{% endif %}

	{% if pagination.total_pages > 1 %}
		<nav class="text-center">
			<ul class="pagination">

				{% if pagination.current == 1 %}
					<li class="disabled">
				{% else %}
					<li>
				{% endif %}
					<a href="?page{% if pageParam is defined %}{{pageParam}}{% endif %}={{ pagination.before }}" aria-label="Previous"><span aria-hidden="true">«</span></a>
				</li>

				{% set ind = [3,2,1] %}
				{% for val in ind %}
					{% if((pagination.current - val) > 0) %}
						<li>
							<a href="?page{% if pageParam is defined %}{{pageParam}}{% endif %}={{ pagination.current-val }}">
								{{ pagination.current - val }}
							</a>
						</li>
					{% endif %}
				{% endfor %}
				<li class="active">
					<a href="?page{% if pageParam is defined %}{{pageParam}}{% endif %}={{ pagination.current }}">{{ pagination.current }} <span class="sr-only">(current)</span></a>
				</li>

				{% set ind = [1,2,3] %}
				{% for val in ind %}
					{% if((pagination.current + val) <= pagination.last) %}
						<li>
							<a href="?page{% if pageParam is defined %}{{pageParam}}{% endif %}={{ pagination.current + val }}">
								{{ pagination.current + val }}
							</a>
						</li>
					{% endif %}
				{% endfor %}

				{% if pagination.current == pagination.last %}
					<li class="disabled">
				{% else %}
					<li>
				{% endif %}
					<a href="?page{% if pageParam is defined %}{{pageParam}}{% endif %}={{ pagination.next }}" aria-label="Next"><span aria-hidden="true">»</span></a>
				</li>
			</ul>
		</nav>
	{% endif %}
{% endblock %}