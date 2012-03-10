#!/bin/bash

#Script which collects the cpuinfo every 10 seconds.
#Can be easily altered if we require longer or shorter times.
#Generates a log file named cpuinfo.log

rm -r cpuinfo.log
while true;
do
python cpuinfo.py >> cpuinfo.log
sleep 10
done
