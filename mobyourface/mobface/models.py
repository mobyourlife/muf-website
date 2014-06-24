from django.db import models


# Contas de Facebook cadastradas
# TO DO: funcionar também para contas pessoais
class FacebookUser(models.Model):
    fb_uid = models.BigIntegerField(default=0, primary_key=True)
    username = models.CharField(max_length=50)
    category = models.CharField(max_length=50)
    about = models.CharField(max_length=500)
    description = models.CharField(max_length=1000)
    phone = models.CharField(max_length=20)
    city = models.CharField(max_length=50)
    country = models.CharField(max_length=30)
    website = models.CharField(max_length=100)
    likes = models.IntegerField(default=0)


# Fotos de capa
class FacebookCover(models.Model):
    fb_user = models.ForeignKey(FacebookUser)
    fb_cvid = models.BigIntegerField(default=0, primary_key=True)
    sync_time = models.DateTimeField('Date Synced')
    source = models.CharField(max_length=500)
    source_downloaded = models.BooleanField(default=False)


# Álbuns sincronizados
class FacebookAlbum(models.Model):
    fb_user = models.ForeignKey(FacebookUser)
    fb_aid = models.BigIntegerField(default=0, primary_key=True)
    name = models.CharField(max_length=100)
    type = models.CharField(max_length=10)
    count = models.IntegerField(default=0)
    created_time = models.DateTimeField('Date Created')
    updated_time = models.DateTimeField('Date Updated')


# Fotos dos álbuns
class FacebookPhoto(models.Model):
    fb_album = models.ForeignKey(FacebookAlbum)
    fb_pid = models.BigIntegerField(default=0, primary_key=True)
    thumb_source = models.CharField(max_length=250)
    full_source = models.CharField(max_length=250)
    thumb_downloaded = models.BooleanField(default=False)
    full_downloaded = models.BooleanField(default=False)