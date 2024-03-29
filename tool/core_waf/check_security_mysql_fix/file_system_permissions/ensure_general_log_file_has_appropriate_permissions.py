import os
import re
import sys
sys.path.insert(0, '/home/anhthc/do_an/')
import helper

error_list = list()


# def check(username, password):
def check(username, password):
    connection = helper.connectToMysql(username,password)
    cursor = connection.cursor()
    flag = True
    if cursor:
        cursor.execute('show variables like \'general_log_file\';')
        dir = cursor.fetchone()
        if dir and dir[1]:
            output = os.popen('ls -la ' + dir[1]).read()
            if output:
                output = output.split()
                if output[0] > '-rw-rw----':
                    error_list.append('[WARNING] general_log_file might not have appropriate permissions.')
                    error_list.insert(0, 13600)
                    flag = False
    if flag:
        error_list.insert(0, 0)
    return error_list

def fix(username, password):
    connection = helper.connectToMysql(username, password)
    cursor = connection.cursor()
    if cursor:
        cursor.execute('show global variables like \'general_log_file\';')
        dir = cursor.fetchone()
        if dir and dir[1]:
            output = os.popen('ls -la ' + dir[1]).read()
            output = output.split()
            if output > '-rw-rw----':
                os.system('chmod 660 ' + dir[1])
                os.system('chown mysql:mysql ' + dir[1])