import MySQLdb as db
import sys
import subprocess as process

table = None

try:
	
	cmd = ['sar','-n','DEV', '1', '1']
	p = process.Popen(cmd, stdout=process.PIPE)
	val = [];
	#Discard the first two lines.
	p.stdout.readline();
	p.stdout.readline();
	
	#Split the line into separate string and remove any empty strings.
	r = filter(lambda x: len(x)>0,p.stdout.readline().split(' '))
	#print r
	#Store the index of the CPU line
	rx = r.index("rxkB/s")
	#print l
	#Loop through the lines for each processor
	for line in p.stdout:
		if line.find("wlan0") != -1 and line.find("Average") == -1 and line != '\n':
			line = filter(lambda x: len(x)>0,line.split(' '))
			print rx,line
			val.append(line.pop(rx))
			val.append(line.pop(rx))
	p.wait()
	
	print "return value ",p.returncode
	print val[0],val[1]
	
	table = db.connect('localhost','aditya','obelix1','cluster');
	cur = table.cursor();
	cur.execute("insert into netinfo (rx,tx,clustID) values (" + str(val[0]) + ',' + str(val[1]) +','+ str(0) +')');
	
except db.Error, e:
	
	print "Error: %d: %s " % (e.args[0],e.args[1])
	sys.exit(1);
	
finally:

	if table:
		table.close();
