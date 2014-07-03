from django.shortcuts import render_to_response, get_object_or_404


def index(request, template_name='mobface/index.html'):
    return render_to_response(template_name, request)