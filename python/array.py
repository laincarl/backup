#coding=utf-8

import numpy as np
'''
old=np.array([[1,1,1],[1,1,1]])
new=old
#new=old.copy()
new[0,:2]=0
print(old)
'''
list=[]
list2=[[x for x in range(10)] for y in range(10)]
for i in range(0,36,6):
	list.append([x for x in range(i,i+6)])
print(list2)
'''
list=list()
j=0
for i in range(6):
	list.append([])
	for k in range(6):
		list[i].append(j)
		j=j+1
list=np.array(list)
list2=np.arange(36).reshape(6,6)
print (list)
print (list2)
'''