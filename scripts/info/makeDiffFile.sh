#!/bin/bash
LANG=HU_hu.UTF-8 

f1="tmp1.txt"
f2="tmp2.tmp"
f3=$3
cp $1 $f1
cp $2 $f2


sh ./makeOneToWork.sh $f1
sh ./makeOneToWork.sh $f2

diff -b -w -B -U 10000 $f1 $f2 > $f3

sed 's/\(^+++\)\(.*\)//g' -i $f3
sed 's/\(^---\)\(.*\)//g' -i $f3
sed 's/\(^@@\)\(.*\)//g' -i $f3

sed 's/\(^[+-]\)\(<\)\(.*>\)\(.*\)/\2\3\n\1\4/' -i $f3
sed 's/\(^[+-]\)\(<\)\(.*>\)\(.*\)/\2\3\n\1\4/' -i $f3
sed 's/\(^[+-]\)\(<\)\(.*>\)\(.*\)/\2\3\n\1\4/' -i $f3
sed 's/\(^[+-]\)\(<\)\(.*>\)\(.*\)/\2\3\n\1\4/' -i $f3

sed '/^[-+]$/d' -i $f3

sed '/^\s*$/d' -i $f3

rm $f1
rm $f2
