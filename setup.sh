#!/bin/sh

DIR=$(basename $(realpath .))

sed -i s/proyecto/$DIR/g db/* config/* proyecto.conf codeception.yml
mv proyecto.conf $DIR.conf
mv db/proyecto.sql db/$DIR.sql
mv github .github
rm -f $0
