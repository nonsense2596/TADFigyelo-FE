#!/bin/bash
LANG=HU_hu.UTF-8 
file="tads/$1.html"
link="https://portal.vik.bme.hu/kepzes/targyak/$1/hu/print/"
nfile="wget.temp"

if [ ! -f $file ]
	then
	wget $link -O $file
	#ITT VAN AZ, HOGY ÚJ LETT HOZZÁADVA!!!!
else
	wget $link -O $nfile
	cmp -s $file $nfile > /dev/null
	if [ $? -eq 1 ]
	then
		#RÉGIT LEMENTJÜK DÁTUMOZVA
		DATE=$(date +"%Y%m%d_%H")
		cp $file "tads/${1}_$DATE.html"
		#DIFF 	file készítés és kiegészítés formázással
		sh ./makeDiffFile.sh $file $nfile "tads/$1.diff.html"
		sed -e 's/\(^[-]\)\(.*\)/<span style="color: #FF0000; font-weight: bold">\2<\/span>/g' -i "tads/$1.diff.html"
		sed -e 's/\(^[+]\)\(.*\)/<span style="color: #00FF00; font-weight: bold">\2<\/span>/g' -i "tads/$1.diff.html"
		# régi file csere újra
		cp $nfile $file
	else
		echo ""
		#UGYANAZ A KÉT FILE NEM TÖRTÉNIK SEMMI
	fi

	rm $nfile
fi
