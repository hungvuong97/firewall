import re
import sys
import base64


path = "/opt/modsecurity/etc/custom/"
print(sys.argv)
f = open(path + sys.argv[1] + ".conf", "ab")

rule = base64.b64decode(sys.argv[3])
f.write("\n" + rule + "\n")
f.close()

