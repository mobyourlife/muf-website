from django.contrib import admin
from mobface.models import FacebookUser, FacebookCover, FacebookAlbum, FacebookPhoto


# Registra os modelos do Mob Your Face no painel de controle
admin.site.register(FacebookUser)
admin.site.register(FacebookCover)
admin.site.register(FacebookAlbum)
admin.site.register(FacebookPhoto)