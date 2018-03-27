# -*- coding: utf-8 -*-
import urllib2
import urllib
import chardet

url="http://www.douban.com"
values={"username":"wang","password":"xxx"}
data=urllib.urlencode(values)
request=urllib2.Request(url,data)
try:
   response = urllib2.urlopen(request).read()
   encoding_dict = chardet.detect(response)
   #print encoding
   web_encoding = encoding_dict['encoding']
   print web_encoding
   if web_encoding == 'utf-8' or web_encoding == 'UTF-8':
      out = open('sketch.txt','w')
      out.write(response)
      out.close()
      print response
   else :
      print response.decode('gbk','ignore').encode('utf-8')
  
   #print response.read().decode('utf-8')
except urllib2.HTTPError,e:
   print e.code
except urllib2.URLError,e:
   print e.reason
else:
	print "OK"
#print u"你好"