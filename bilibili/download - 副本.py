#coding=utf-8
import requests

headers={'Referer':'https://www.bilibili.com/'}

# appkey:84956560bc028eb7
# 12737ff7776f1ade
url='http://tx.acgvideo.com/39/07/23700739/23700739-1-80.flv?txTime=1506877011&platform=pc&txSecret=26f43ebf5fb3d6784c02ea99263f6e02&oi=2073294418&rate=497192&hfb=b99ffc3c5c68f00a33123bb25f882d5b'

r = requests.get(url,headers=headers,stream=True)
f = open('video\\%s.mp4' % 'ss', "wb")
m = requests.head(url,headers=headers)
file_size = int(m.headers['Content-Length'])
print file_size
f.truncate(file_size)
i=0
for chunk in r.iter_content(chunk_size=2048):
	if chunk:
	    print i
	    i=i+1
	    f.write(chunk)
f.close()
# https://interface.bilibili.com/playurl?cid=23700739&appkey=84956560bc028eb7&otype=json&type=&quality=0&qn=0&sign=3d6ed6e27697777961a80cc6615898e6

# r = requests.get('http://api.bilibili.com/view?appkey=12737ff7776f1ade&id=14889655&page=0')
# print r.text.decode('utf8')