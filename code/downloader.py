'''
The landing links are retrieved from the database created in postgres and the
content present in those links are downloaded by downloader.py and stored in an
unparsed manner in the mongodb collection webcrawler.
The default download status and parsed status are set to 0 and tries are limited up
to 3 attempts for each link failing which the downloader.py discards the link and does
not visit the link again to download the content. After successfully downloading
the data and storing into mongodb the download status is changed to 1. In case
of any HTTP error, it is handled by the program.
'''
import md5
import bs4
import sys
import os
import Queue
import urllib2
import hashlib
import pprint
import datetime
import psycopg2
import time
import pymongo
from pymongo import MongoClient

client=MongoClient('localhost',27017)
db=client.store
collection=db.webcrawler
conn = psycopg2.connect(database="crawler", user="postgres", password="shree", host="127.0.0.1", port="5432")
print "Opened database successfully"
cur = conn.cursor()
count=0
#CRAWLER
cur.execute("SELECT url,checksum,category from land")
colls= cur.fetchall()
for col in colls:
	u=col[0]
	print u
	c=col[1]
	#print c
	d=col[2]
	cur.execute("""SELECT ds,tries,ps from land WHERE checksum='%s'"""%(c,))
	val= cur.fetchall()
	for v in val:
		#print v 
		print v[0]
		ds=v[0]
		print v[1]
		tries=v[1]
		ps=v[2]
	if (v[0]==0) and (v[1]==3 or v[1]==2 or v[1]==1):
		try:
			webpage = urllib2.urlopen(col[0])
			content = webpage.read().decode('utf8')
			docs={'cs':c,'url':u,'con':content,'cat':d}
			collection.save(docs)
			tries=tries-1
			#print tries
			cur.execute("""UPDATE land SET ds=1,tries=%s WHERE checksum='%s'"""%(tries,col[1],))
			conn.commit()
			count=count+1
			print '---------------'
			print count
			print 'Finish save'
		except urllib2.HTTPError,err:
			print '-------ERROR--------'
			print err.code
			tries=tries-1
			cur.execute("""UPDATE land SET tries=%s WHERE checksum='%s'"""%(tries,col[1],))
			conn.commit()
						
	else:
		print 'NO SAVE'
	
#if count!=0:
#	if (ps==0):
#		query = {"cs":c}
 #       	document = collection.find(query)
  #      	print document
#	else:
#		print 'PARSED'

