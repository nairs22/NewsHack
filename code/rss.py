'''
The crawler is the basic building block of the News Crawler which is responsible
for extracting the landing links from the given seed URLs. The crawler is expected
to generate and update the timestamp values for each time the seed URLs crawl
new links. The landing links obtained from the seed links are associated with a
unique 32-bit hexadecimal value which are stored as the checksum of those links
for duplication removal. The following lines of code of python script are executed
to obtain the aforementioned functionality of the crawler:
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
import time
import psycopg2

#CONNECTIVITY
conn = psycopg2.connect(database="crawler", user="postgres", password="shree", host="127.0.0.1", port="5432")
print "Opened Postgres database successfully"
cur = conn.cursor()
#CRAWLER
cur.execute("SELECT url from rss")
cols = cur.fetchall()
count=0
for col in cols:
 
  	print "URL = ", col[0]
	for line in col:
		url = line.strip()
		webpage = urllib2.urlopen(url)
		content = webpage.read().decode('utf8')
		soup = bs4.BeautifulSoup(content,'xml')
		#print soup.prettify()
		for lists in soup.find_all('item'):
			for para in lists.find_all('description'):
                              	clean1=para.text 
                        	clean=clean1.encode('ascii','ignore')
				hex=hashlib.sha224(clean).hexdigest()
                    		for anchor in lists.find_all('link'):
					print anchor.text
					try:
						cur.execute("""SELECT category from rss WHERE url='%s'"""%(col[0]))
						cat=cur.fetchall()
						print cat[0]
						query="INSERT INTO land(url,checksum,category) VAlUES (%s,%s,%s);"
						data=(anchor.text,hex[:16],cat[0])
						cur.execute(query,data)
						conn.commit()	
						a=datetime.datetime.now()
						query="UPDATE rss SET ts=%s WHERE URL=%s;"
						data=(a,url);
						#print data
						cur.execute(query,data);
						conn.commit()
						count=count+1
						print '------------------'
						print count
					except psycopg2.IntegrityError:
                                        	print "error"
                                           	conn.rollback()
                                           	pass

	
#if count!=0:
	#os.system("python downloader.py")
	#print "Call Downloader"
