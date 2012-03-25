#!/bin/bash
rm -r cpuinfo.log
while true;
do
python cpuinfo.py >> cpuinfo.log
sleep 10
done
