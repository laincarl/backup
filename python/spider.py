#coding=utf-8
import requests
import json
data = {
"content": "cdd","parent_id":"10704028"
}
values = json.dumps(data)
#r = requests.get('http://www.jianshu.com/notes/11994487/comments?comment_id=&author_only=false&since_id=0&max_id=1586510606000&order_by=likes_count&page=1')
headers={'Accept':'application/json','Accept-Encoding':'gzip,deflate','Accept-Language':'zh-CN,zh;q=0.8','Connection':'keep-alive','Content-Type':'application/json','Host':'www.jianshu.com','Origin':'http://www.jianshu.com','User-Agent':'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36','Referer':'http://www.jianshu.com/p/cb54b50489f6','Cookie':'UM_distinctid=15abc691293107-0960a4604-3c61410e-1fa400-15abc691294858; CNZZDATA1258679142=348702210-1486972989-https%253A%252F%252Fwww.baidu.com%252F%7C1492918675; _gat=1; remember_user_token=W1s1MTkyODU3XSwiJDJhJDEwJDFURzA1eEVqcm5pQS55eFlVSHBscXUiLCIxNDk0MjQ5Njg3LjM2ODg5MjQiXQ%3D%3D--9add919d2f671d5c4b8698003bc2e94173ea5d68; _ga=GA1.2.842329457.1486977654; _gid=GA1.2.399806622.1494249755; Hm_lvt_0c0e9d9b1e7d617b3e6842e85b9fb068=1494044417,1494219753,1494222808,1494249730; Hm_lpvt_0c0e9d9b1e7d617b3e6842e85b9fb068=1494249755; _session_id=WXlZYzBjUzB2UTEwYWVUNmhIYktWdjNtR1BnbzNzWVpLZE55NjNlSnNxR2VrOU82akhzZzh1eGFpUTBkUDM4WVkreHR3aHBKckhXNXFRNUpVaU5sSzBIN3JkL0JvVlBsb2pZVUt6blRJbzJWTDg5TVhvamZKU2JBY2UzM3JKM1FZRU9HcWZWRTFFSFZGTzM0a1cwWC9DUUV3VThrOXJ2dWlGY2dxaWVveDh6cmJvYm9MSnQ2dGY2b2pvNksrMUk3NDBvd2hDSmw3dHd0WlZGMHJQa0liRWM0Y3JYY21UT1d3L1dKUmkxbDgyVnlpTEQvQ0lHK0IxRlNtY1JoanpCWWFVbi9YdUNoY0pNN05HdVZEWXBSSHJLLzBnM2Q1L2NvMXhkYVB4UzJPWk9yZ3Uzck1tWEJFNENaVkZWM2pSWFV0OWpIMnhoeHFYQ1lhaTh1N3dzSGU2bjFmRjlYNHJYMUtPZUFmd05KWFJGaDltd2NObzFIeC9oSE1WenNCajhsOFIxTjI3OG43TW5nd3BaaEpxMnduZFNiVW5MK01wVHp1WTNBQjhqZHY0cz0tLUVwNmFUQlc2N0tqcm1IUjEzbmxjWlE9PQ%3D%3D--70bc86bc8a9308cef8a063af09b8c33d541c06bb'}


#r = requests.post('http://cqu.xuetangx.com/courses/course-v1:CQU+CQUEDS20502+2017_T1/xblock/block-v1:CQU+CQUEDS20502+2017_T1+type@problem+block@'+problem_id+'/handler/xmodule_handler/problem_show',headers=headers)
# r = requests.post('http://www.jianshu.com/notes/11381439/comments',data=values,headers=headers)
cookies="__huid=11gx3kCZHXdOjJz1eUoIGVAJfv5EShXJfhRijtgOuMdLo=; __hsid=c75e3a99ad75fc29; __guid=132730903.4113323648143922000.1505441161480.3438; Q=u%3D360H291384510%26n%3D123%25PQ%25S9%25ON%25S3%26le%3DZGN0Amx3Zwt1ZlH0ZUSkYzAioD%3D%3D%26m%3DZGZlWGWOWGWOWGWOWGWOWGWOBQNm%26qid%3D291384510%26im%3D1_t0177c69700e86935cb%26src%3D360se%26t%3D1; T=s%3D0defb100c1b16ab7b68453c68f8b0ff6%26t%3D1505441203%26lm%3D%26lf%3D1%26sk%3Dbfc8c97013e06200655d38683928ddac%26mt%3D1505441203%26rc%3D%26v%3D2.0%26a%3D1";
#print(r.url)
r = requests.post('http://profile.se.360.cn/download.php?filetype=2&cf=se9_auto&module_version=9.1.0.348&qid=291384510&mid=aacad13ad9b454391cb3c8ab95eff41e&guid=6b32b3463507a3eb2ce444381f545ad6&main_version=9.1.0.348&usercenter_version=2.0.2.1050&pid=360se&ppid=2976&tid=8924&vt=1286147',cookies=cookies)

print(r.text)  