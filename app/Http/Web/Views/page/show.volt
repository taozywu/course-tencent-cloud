{% extends 'templates/full.volt' %}

{% block content %}

    <div class="page-info container">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>{{ page.title }}</legend>
            <div class="layui-field-box page-content">
                {{ page.content }}
            </div>
        </fieldset>
    </div>

{% endblock %}