#!/bin/bash           
LANG=HU_hu.UTF-8

while read line           
do           
    sh ./doOneLink.sh $line $1
done <"$1"/tad.txt
