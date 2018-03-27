#coding=utf-8
import requests

html = requests.get('https://i.ytimg.com/vi/pnxWt4EF_oI/maxresdefault.jpg')
#https://i.ytimg.com/vi/fOBE6hbZ9IA/maxresdefault.jpg
#html = requests.get('https://i.ytimg.com/vi/pnxWt4EF_oI/sddefault.jpg')
#html = requests.get('https://i.ytimg.com/vi/pnxWt4EF_oI/hqdefault.jpg')
with open('picture.jpg', 'wb') as file:
    file.write(html.content)