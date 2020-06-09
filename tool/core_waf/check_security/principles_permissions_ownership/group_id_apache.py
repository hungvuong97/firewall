import os
import sys
sys.path.insert(0, '/var/log/core_waf/check_security/')
import helper

error_list = list()

def check():
	# print ''
	# print ' Set Group Id on Apache Directories and Files '.center(85, '#')
	# print ''
	a = list()
	for i in helper.get_apache_dir():
		with os.popen("find "+ i +" 2>/dev/null \! -group root ") as f:
			for line in f:
				a.append(line[:-1])
		f.close()
	if len(a) != 0:
		error_list.append('[WARNING] Detect file in Apache directory with group not root' )
		error_list.insert(0, 5)
	else:
		error_list.insert(0, 0)
	return error_list

def get_list():
	a = list()
	for i in helper.get_apache_dir():
		with os.popen("find "+ i +" 2>/dev/null \! -group root ") as f:
			for line in f:
				a.append(line[:-1])
		f.close()
	return a

def fix():
	for i in get_list():
		os.system("chgrp -R root "+ i )


def fix_o():
	fix()

# for i in check():
# 	print i
# check()
# print check_groupid()