import pandas as pd

df=pd.DataFrame([{'Product ID':4109,'Price':5.0,'Product':'Sushi Roll'},
				 {'Product ID':1412,'Price':0.5,'Product':'Egg'},
				 {'Product ID':8931,'Price':1.5,'Product':'Bagle'}])

df1=pd.DataFrame([{'Customer':'All','Product ID':4109,'Quantity':1},
				 {'Customer':'Eric','Product ID':1412,'Quantity':12},
				 {'Customer':'Ande','Product ID':8931,'Quantity':6},
				 {'Customer':'Sam','Product ID':4109,'Quantity':2}])
df.reset_index()
df1.reset_index()
print(df)
print(df1)
df3=pd.merge(df,df1, how='outer', left_on='Product ID', right_on='Product ID')
df3.reset_index()
df3.set_index('Price')
print(df3)