#coding=utf-8
import urllib,requests
import json
import re
data = {
"content": "cdd","parent_id":"10704028"
}
values = json.dumps(data)

#r = requests.get('http://www.jianshu.com/notes/11994487/comments?comment_id=&author_only=false&since_id=0&max_id=1586510606000&order_by=likes_count&page=1')
headers={'Referer':'https://www.bilibili.com/'}
headers2={'Referer':'https://www.bilibili.com/video/av14889655/'}

# def cbk(a,b,c):    
#     print 'ss'
url='https://tx.acgvideo.com/88/89/24268988/24268988-1-64.flv?txTime=1506858889&platform=pc&txSecret=2033bce682163f09783abf1298c6e2f1&oi=2073294418&rate=485475&hfb=b99ffc3c5c68f00a33123bb25f882d5b'
# request.urlretrieve(url, local)
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
# r = requests.get(url,headers=headers)
# print r.text

# r = requests.get('http://api.bilibili.com/view?appkey=12737ff7776f1ade&id=14940301')
# urllib.urlretrieve('https://cn-sxty1-cu.acgvideo.com/vg0/1/cb/24234375-1.mp4?expires=1506833400&platform=pc&ssig=x8laU-FVLzrbun5Dvq7yUg&oi=794810000&nfa=iKQJtLw3Fy5f05Q/mDvFYw==&dynamic=1&hfa=2078505744&hfb=Yjk5ZmZjM2M1YzY4ZjAwYTMzMTIzYmIyNWY4ODJkNWI=','video\\%s.mp4' % 'ss',None,myheaders)
#print(r.url)
# print(r.text)  

# pattern = re.compile(r'<dt>(.*?)</dt>')
#pattern = re.compile(r'd_post_content j_d_post_content  clearfix">(.*?)</div>')
# match = re.findall(pattern,r.text)
# print (r)
# ["https:\/\/cn-sxty1-cu.acgvideo.com\/vg0\/1\/cb\/24234375-1.mp4?expires=1506833400&platform=pc&ssig=x8laU-FVLzrbun5Dvq7yUg&oi=794810000&nfa=iKQJtLw3Fy5f05Q\/mDvFYw==&dynamic=1&hfa=2078505744&hfb=Yjk5ZmZjM2M1YzY4ZjAwYTMzMTIzYmIyNWY4ODJkNWI="]
# 24447766
# 17120153
# Access-Control-Allow-Origin:
# Access-Control-Expose-Headers:Content-Length,Content-Range
# Cache-Control:max-age=600
# Connection:keep-alive
# Content-Length:24447766
# Content-Range:bytes 0-24447765/24447766
# Content-Type:video/mp4
# Date:Sun, 01 Oct 2017 03:55:54 GMT
# ETag:"fd0981c723727fc8ef9d33b98561d53edf6ec5ee"
# Expires:Sun, 01 Oct 2017 04:05:53 GMT
# Last-Modified:Sat, 30 Sep 2017 03:44:15 GMT
# Server:NWSs
# X-Cache-Lookup:Hit From Inner Cluster
# X-Daa-Tunnel:hop_count=1
# X-NWS-LOG-UUID:51f15d76-64d0-4f68-a7da-aee95593869a

# Request URL:https://interface.bilibili.com/playurl?cid=24297387&appkey=84956560bc028eb7&otype=json&type=&quality=0&qn=0&sign=8f2638984a44172755b33b99231e716e
# {"from":"local","result":"suee","quality":16,"format":"mp4","timelength":232362,"accept_format":"mp4","accept_quality":[16],"seek_param":"start","seek_type":"second","durl":[{"order":1,"length":232362,"size":24447766,"url":"http://tx.acgvideo.com/87/73/24297387/24297387-1-16.mp4?txTime=1506837353&platform=pc&txSecret=2eec43db5491ff440cb7e7062b1665cb&oi=2073294418&rate=210428&hfb=b99ffc3c5c68f00a33123bb25f882d5b","backup_url":["http://ws.acgvideo.com/b/1c/24297387-1.mp4?wsTime=1506837353&platform=pc&wsSecret2=3c6311c96735aca1c59a2f8f6556c6d5&oi=2073294418&rate=178"]}]}
# cid:24297387
# appkey:84956560bc028eb7
# otype:json
# type:
# quality:0
# qn:0
# sign:8f2638984a44172755b33b99231e716e