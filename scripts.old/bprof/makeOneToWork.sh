#!/bin/bash
LANG=HU_hu.UTF-8 

file=$1

sed 's/[>]\(.*\)/>\n\1/g' -i $file
sed 's/\(.*\)[<]/\1\n</g' -i $file
sed 's/></>\n</g' -i $file

sed 's/[>]\(.*\)/>\n\1/g' -i $file
sed 's/\(.*\)[<]/\1\n</g' -i $file
sed 's/></>\n</g' -i $file

sed 's/[>]\(.*\)/>\n\1/g' -i $file
sed 's/\(.*\)[<]/\1\n</g' -i $file
sed 's/></>\n</g' -i $file

sed '/^\s*$/d' -i $file
