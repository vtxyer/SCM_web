#!/usr/local/bin/bash

i=1
while [ $i -le 21 ]
do
    ac=`sed -n "$i p" a| awk '{print $1;}'`
    sname=`sed -n "$i p" a | awk '{print $2;}'`
    ps=`sed  -n "$i p" a| awk '{print $3;}'`
    echo "insert into school set account='$sname',sname='$ac',passwd='$ps' ;" | mysql -u root -D SCM
    let i++
done
