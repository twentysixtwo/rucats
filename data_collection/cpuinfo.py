import MySQLdb as db
import sys
import subprocess as process

table = None

try:
	
	cmd = ['mpstat','-P','ALL', '1', '1']
	p = process.Popen(cmd, stdout=process.PIPE)
	i = 0;
	d = {}
	
	#Discard the first two lines.
	p.stdout.readline();
	p.stdout.readline();
	
	#Split the line into separate string and remove any empty strings.
	r = filter(lambda x: len(x)>0,p.stdout.readline().split(' '))
	#print r
	#Store the index of the CPU line
	l = r.index("CPU")
	#print l
	#Loop through the lines for each processor
	for line in p.stdout:
		if line.find("all") == -1 and line.find("Average") == -1 and line != '\n':
			line = filter(lambda x: len(x)>0,line.split(' '))
			#print line
			key = line.pop(l)
			val = line.pop(l)
			d[key]=val
	p.wait()
	
	#print "return value ",p.returncode
	print d
	
	table = db.connect('localhost','aditya','obelix1','cluster');
	cur = table.cursor();
	for key in d.iterkeys():
		print key,d[key]
		cur.execute("insert into cpuinfo (data,procID) values (" + d[key] +','+key +')');
	
except db.Error, e:
	
	print "Error: %d: %s " % (e.args[0],e.args[1])
	sys.exit(1);
	
finally:

	if table:
		table.close();
