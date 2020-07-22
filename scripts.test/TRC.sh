#!/bin/bash           
LANG=HU_hu.UTF-8

while read line           
do           
    sh ./doOneLink.sh $line 
done <"$1".txt
