#!/bin/bash
datafile=/home/pi/r.data
loc=("china/chengdu/lingyansi" "kunming" "liangshan" "panzhihua" "shanghai" "beijing" "shenzhen" "chongqing" ) 
echo "timestamp: `date`" >>  ${datafile}
#date >>  ${datafile}
for var in ${loc[@]};  
do  
    echo $var  
   locat=`echo ${var##*/}`
  echo "0" > /tmp/s.${locat}
  echo "-----------------------------------------------------------"  >>  ${datafile}
#  curl http://aqicn.org/city/${var} > /tmp/s.${locat}
  w3m -dump_source http://aqicn.org/city/${var} > /tmp/s.${locat}
  python getaqi.py /tmp/s.${locat} >>  ${datafile}
done  
  echo "**********************************************************"  >>  ${datafile}

