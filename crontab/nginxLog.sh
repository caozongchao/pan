#!/bin/bash
# Program:
#   Auto cut nginx log script.
# 2016/6/15 luozhibo 

# nginx日志路径 /var/log/nginx/
LOGS_PATH=/www/wwwlogs/
TODAY=$(date -d 'today' +%Y-%m-%d)
#echo $TODAY

# 移动日志并改名
mv ${LOGS_PATH}/www.yssousuo.com.log ${LOGS_PATH}/${TODAY}_www.yssousuo.com.log

# 向nginx主进程发送重新打开日志文件的信号
service nginx restart
