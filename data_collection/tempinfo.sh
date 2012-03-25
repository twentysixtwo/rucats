#!/bin/bash
rm -rf tempinfo.log
while true;
do
python tempinfo.py >> tempinfo.log
sleep 10
done
