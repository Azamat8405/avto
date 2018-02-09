{% if new_messages %}

	{% for mess in new_messages  %}
		<div>
			<div>
			{{mess.title}}
			</div>
			<div>
				{{mess.text}}
			</div>
		</div>

	{% endfor %}
{% endif %}