top -bn 1 | awk '{ printf("%-8s|| %-8s||  %-8s|| %-8s||  %-8s|||",$12, $9, $10,$11,$1); }'
