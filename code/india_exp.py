''''
Parser for Indian Express
'''

import xml.etree.cElementTree as ETI
import bs4
import md5
import sys
import urllib2
import xml.etree.cElementTree as ET
import time
import xml.etree.cElementTree as ETI
import bs4
import md5
import sys
import urllib2
import psycopg2
import os
import Queue
import hashlib
import datetime
import pymongo
from pymongo import Connection
from pymongo.errors import ConnectionFailure
import xml.etree.cElementTree as ET
from pymongo import MongoClient
import codecs
#PARSER INDIAN EXPRESS

def getTitle(soup):
	return soup.find('title').text.strip()
	
def getContent(soup):
	check=0
	desc = ''
	for para in soup.find_all('p'):
		desc = desc+' '+para.text
		check=1
	if check==1:
		return desc.strip()
	else:
		print 'Except'
		sys.exit(1)
	
def getListImages(soup):
	  try:
                imgs=soup.find('div',{'class':'story-image punchline'}).find('img')['src']
                ET.SubElement(doc, "field",name="links").text=imgs
                return imgs
          except:
                print 'NO IMAGES'
print'IE'	
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
cs=sys.argv[1]
data=db.webcrawler.find({'cs':cs},{'con':1,'url':1,'cat':1,'_id':0})
for i in data:
	x=i.values()
	#print x
	#print x[0] #URL
	#print x[1] #Content
	#print x[2] #cat
date = datetime.datetime.now()
timestr=date.strftime("%Y-%m-%d")
date_iso=date.isoformat()
datestr=date_iso+'Z' 
soup = bs4.BeautifulSoup(x[1])
root = ET.Element("add")
doc = ET.SubElement(root, "doc")
ET.SubElement(doc, "field", name="id").text = cs
ET.SubElement(doc, "field", name="title").text = getTitle(soup)
ET.SubElement(doc, "field", name="last_modified").text = datestr
ET.SubElement(doc, "field", name="category").text =x[2]
ET.SubElement(doc, "field", name="url").text = x[0]
ET.SubElement(doc, "field", name="content").text =getContent(soup)
getListImages(soup)
tree=ET.ElementTree(root)
tree.write('/home/shreya/Desktop/solr/example/exampledocs/'+timestr+'.xml')
os.chdir("/home/shreya/Desktop/solr/example/exampledocs/")
os.system("java -jar post.jar "+timestr+".xml")
try:
	cur.execute("""UPDATE land SET ps=1 WHERE checksum='%s'"""%(cs,))
	conn.commit()
except psycopg2.DatabaseError, e:
    	if conn:
        	conn.rollback()
    		print 'Error %s' % e    
    		sys.exit(1)	
sys.exit(1)
