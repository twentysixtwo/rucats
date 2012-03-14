import MySQLdb as db
import sys
import subprocess as process

table = None

try:
	
	cmd = ['sensors']
	p = process.Popen(cmd, stdout=process.PIPE)
	i = 0;
	d = {}
	
	#Loop through the lines for each processor
	for line in p.stdout:
		if (line.find("CPU") != -1 or line.find("Core") != -1) and line != ' ':
		#	line = filter(lambda x: len(x)>0,line.split(' '))
			plusIndex = line.find("+") + 1;
			degreeIndex = line.find("\xc2")
			val = line[plusIndex:degreeIndex]		
			d[i]=val
			i = i + 1
	p.wait()
	print "return value ",p.returncode
	print d
	
	table = db.connect('hostname','username','password','database_name');
	cur = table.cursor();
	for key in d.iterkeys():
		print key,d[key]
		cur.execute("insert into tempinfo (data,procID) values (" + d[key] +','+ str(key) +')');
	
except db.Error, e:
	print "Error: %d: %s " % (e.args[0],e.args[1])
	sys.exit(1);
finally:
	if table:
		table.close();
