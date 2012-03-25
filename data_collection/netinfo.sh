#!/bin/bash
rm -r netinfo.log
while true;
do
python netinfo.py >> netinfo.log
sleep 10
done
