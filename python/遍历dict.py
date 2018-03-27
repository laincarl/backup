#coding=utf-8
import requests
import re
ll=[]
Asia=[]
Africa=[]
North_America=[]
South_America=[]
Antarctica=[]
Europe=[]
Oceania=[]
dict={'Asia':Asia,'Africa':Africa,'North_America':North_America,'South_America':South_America,'Antarctica':Antarctica,'Europe':Europe,'Oceania':Oceania}
list=['Asia','Africa','North_America','South_America','Antarctica','Europe','Oceania']
for li in list:
	r = requests.get('https://simple.wikipedia.org/wiki/'+li)
	pattern2 = re.compile(r'title="(.*?)">')
	pattern = re.compile(r'<li>(.*?)</li>')
	match = re.findall(pattern,r.text)	
	#print(text)
	if match:
		match2 = re.findall(pattern2,str(match))
		if match2:
			for line in match2:
				dict[li].append(line)
				#print(line)
ind='Canada'
le=len(ll)
for k,d in dict.items():
	
	if ind in d:
		ll.append(k)
if le==len(ll):
	ll.append('ss')
print(ll)
