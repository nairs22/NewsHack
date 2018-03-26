'''
Parser.py successfully connects to Mongo gb and Postgres SQL. There are four parsers for each of the available landing links which are retrieved
from the postgresql database crawler. The URL of each landing link is compared to a predefined string and respective parsers are called for execution.
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
from pymongo import Connection
from pymongo.errors import ConnectionFailure
import xml.etree.cElementTree as ET
from pymongo import MongoClient

count=0
try:
	client=MongoClient('localhost',27017)
       	print "MongoDB connected successfully"
except ConnectionFailure, e:
       	sys.stderr.write("Could not connect to MongoDB: %s" % e)
       	sys.exit(1)
db=client.store
collection=db.webcrawler
print "MongoDB connected to Collection"
try:
	conn = psycopg2.connect(database="crawler", user="postgres", password="shree", host="127.0.0.1", port="5432")
	cur = conn.cursor()
	print "Postgres connected successfully"		
except psycopg2.DatabaseError, e:
	print 'Error %s' % e
	sys.exit(1)
cur.execute("SELECT url,checksum from land")
rows= cur.fetchall()
for row in rows:
        #print row[0]  #URL
        #print row[1]  #Checksum
	#print sys.argv	
	cur.execute("""SELECT ps,ds from land WHERE checksum='%s'"""%(row[1]))
        parse= cur.fetchall()
        for ps in parse:
                #print ps     #Parser in tuple
                #print ps[0]  #Parser
		#print ps[1]
		count=count+1
		print '-----------------'
		print count  
        	if (ps[0]==0 and ps[1]):
                	#print data
			#print unparsed
			temp=row[1]
			cmp_str=row[0].split(".co",1)[0]
	
			if cmp_str=='http://indianexpress':
				my_dir = os.path.dirname(sys.argv[0])
				os.system('%s %s %s' % (sys.executable,os.path.join(my_dir, 'india_exp.py'),os.path.join(my_dir,temp)))
			elif cmp_str=='http://www.mid-day':
				my_dir = os.path.dirname(sys.argv[0])
				os.system('%s %s %s' % (sys.executable,os.path.join(my_dir, 'mid_day.py'),os.path.join(my_dir,temp)))
			elif cmp_str=='http://indiatoday.feedsportal':
				my_dir = os.path.dirname(sys.argv[0])
				os.system('%s %s %s' % (sys.executable,os.path.join(my_dir, 'india_today.py'),os.path.join(my_dir,temp)))
			elif cmp_str=='http://timesofindia.feedsportal':
				my_dir = os.path.dirname(sys.argv[0])
				os.system('%s %s %s' % (sys.executable,os.path.join(my_dir, 'toi.py'),os.path.join(my_dir,temp)))

			else:
				print "EXIT"

	  		print 'Saved xml'

       	 	else:
                	print 'ALREADY PARSED'
       
