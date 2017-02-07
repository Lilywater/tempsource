#!/usr/bin/env python
import sys
import os
import re
import urllib2
import MySQLdb


def read_log( filename):
        f = open(filename)
        try:
            return f.read()
        finally:
            f.close()



if __name__ == '__main__':
   lines = "";
   if 1 < len(sys.argv) < 4:
      lines =  read_log(*sys.argv[1:])
      print lines
   else:
      print "Please input the filename of raw data"
      exit
   cp=re.compile(r""" 
    timeline:\s+(\d{4}-\d{2}-\d{2}T\d{2})\n
    ((?:\d+\s[a-zA-Z0-9,_.]+$\n)+)
    temprature\s(\S+)$\n 
    humidity\s(\S+)$
    """ ,re.VERBOSE |re.MULTILINE);
   mo = cp.search(lines);
   dt = mo.group(1)
   dt = dt.replace('T',' ')
   dt = dt + """:00:00"""
   aqis = mo.group(2)
   tempra = mo.group(3)
   humid = mo.group(4)
   if mo:
#      print "timeline:", mo.group(1), mo.group(2), mo.group(3)
#      print aqis
       db = MySQLdb.connect("localhost","root","123","mysql")
       curs=db.cursor()
       try:
           tablename = ''
           first = 1
           for mo2 in  re.finditer("(\d+)\s([a-zA-Z0-9,_.]+)$\n",aqis, re.MULTILINE):
                   loc=mo2.group(2)
                   pm25=mo2.group(1)
                 #  print loc 
                   if first:
                      index = loc.find(',_')
                      if index != -1:
                        tablename = loc[index+2:]
                      else:
                        tablename = loc
                      first = 0
                      print "table name is",  tablename
                   sqlclause = """INSERT INTO """ + tablename + """ values(\'""" + loc + """\',\'""" + dt + """\',""" + pm25 + """)"""
                   print "DATA committed "  , sqlclause
                   curs.execute(sqlclause)
           sqlclause2 = """INSERT INTO """ + tablename + """_TH"""+ """ values(\'""" + dt  + """\',""" + tempra + """,""" + humid + """)"""
           print sqlclause2
           curs.execute(sqlclause2)
           db.commit()
           print "DATA committed"
           
   
       except:
           print "Error: the database is being rolled back"
           db.rollback()

#       curs.execute ("SELECT * FROM Chengdu_TH")
#       for reading in curs.fetchall():
#            print str(reading[0])+"	"+str(reading[1])+" 	"+ str(reading[2])
#   db = MySQLdb.connect("localhost","root","123","mysql")
#   curs=db.cursor()
##   try:
##       curs.execute ("""INSERT INTO Chengdu 
##            values( 'Xishan_squrea,_Kunming','2017-02-03 14:00:00', 18)""")
##
##       db.commit()
##       print "Data committed"
##
##   except:
##       print "Error: the database is being rolled back"
##       db.rollback()
#   curs.execute ("SELECT * FROM Chengdu")
#
##print "\nDate     	Time		Zone		Temperature"
##print "==========================================================="
#
#   for reading in curs.fetchall():
#     print reading[0]+"	"+str(reading[1])+" 	"+ str(reading[2])
#
