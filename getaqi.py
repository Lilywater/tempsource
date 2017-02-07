#!/usr/bin/env python
import sys
import os
import re
import urllib2


def read_log( filename):
        f = open(filename)
        try:
            return f.read()
        finally:
            f.close()

def get_aqi(g1, g2):
     pat = re.compile('{"aqi":"(\d+)".*?"name":"(.*?)","curl":.*?}');
     for m in pat.finditer(g1):
       if(not re.search(r'\\',m.group(2))):
         print  m.group(1), (m.group(2)).replace(" ","_")
     m= pat.search(g2);

     if(m and not re.search(r'\\',m.group(2))):
        print  m.group(1), (m.group(2)).replace(" ","_")



if __name__ == '__main__':
   lines = "";
   if 1 < len(sys.argv) < 4:
      lines =  read_log(*sys.argv[1:])

#2    ((?:{.*})+?,)
#2    ({.*})\]}\)
   cp=re.compile(r""" 
    "(\d{4}-\d{2}-\d{2}T\d{2}):.*?"},
    "nearest":\[   #keyword
    ((?:{"aqi":"\d+","vtime":\d+,"id":"[^"]+","name":"[^"]+","curl":"[^"]+","geo":\["[0-9.]+","[0-9].+"\]})+,)
        ({"aqi":"\d+","vtime":\d+,"id":"[^"]+","name":"[^"]+","curl":"[^"]+","geo":\["[0-9.]+","[0-9].+"\]})
     \]
    """ ,re.VERBOSE |re.MULTILINE);
   mo = cp.search(lines);
   mo2= re.search(r'\[(-*\d+?),-*\d+?,-*\d+?\],"i":"[0-9a-zA-Z_ ,]+  t \(temp\.\).*?\[(\d+?),\d+?,\d+?\],"i":"[0-9a-zA-Z_ ,]+  h \(humidity\)',lines);
   if mo:
      print "timeline:", mo.group(1)
      get_aqi(mo.group(2),mo.group(3));
   if mo2:
      print "temprature", mo2.group(1);
      print "humidity", mo2.group(2);

