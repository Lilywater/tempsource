#!/bin/bash
datafile=/home/pi/r.data
loc=("china/chengdu/lingyansi" "kunming" "panzhihua" "shanghai" "beijing" "shenzhen" "chongqing") 
#loc=("shenzhen" "chongqing") 
date >>  ${datafile}
for var in ${loc[@]};  
do  
    echo $var >> ${datafile} 
   locat=`echo ${var##*/}`
#  echo "0" > /tmp/s.${locat}
#  echo "-------"  >>  ${datafile}
#  curl http://aqicn.org/city/${var} > /tmp/s.${locat}
#  python getaqi.py /tmp/s.${locat} >>  ${datafile}
done  

