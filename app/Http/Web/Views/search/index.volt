{% extends 'templates/main.volt' %}

{% block content %}

    {% set type = request.get('type','trim','course') %}
    {% set query = request.get('query','striptags','') %}

    {{ partial('macros/course') }}

    <div class="layui-breadcrumb breadcrumb">
        <a href="/">首页</a>
        <a href="#">搜索</a>
        <a><cite>{{ query }}</cite></a>
    </div>

    <div class="layout-main clearfix">
        <div class="layout-content">
            {% if pager.total_pages > 0 %}
                <div class="wrap">
                    {% if type == 'course' %}
                        {{ partial('search/course') }}
                    {% elseif type == 'other' %}
                        {{ partial('search/other') }}
                    {% endif %}
                </div>
                {{ partial('partials/pager') }}
            {% else %}
                <div class="search-empty wrap">
                    <div class="icon"><i class="layui-icon layui-icon-face-surprised"></i></div>
                    <div class="text">没有找到<span class="query">{{ query }}</span>相关内容，换个关键字试试吧！</div>
                </div>
            {% endif %}
        </div>
        <div class="layout-sidebar">
            {{ partial('search/sidebar') }}
        </div>
    </div>

{% endblock %}