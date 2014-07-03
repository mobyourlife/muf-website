from django.conf.urls import patterns, include, url

urlpatterns = patterns('mobface.views',
    url(r'^$', 'index', name='mobface_index'),
)