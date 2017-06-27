# -*- coding: utf-8 -*-
import urllib2, re,time
import MySQLdb as mdb
import traceback, Queue


DB_HOST = '127.0.0.1'
DB_PORT = '3306'
DB_USER = 'root'
# MySQL密码
DB_PASS = 'root'
# 数据库名称
DB_NAME = 'pan'
SPIDER_INTERVAL = 10  # 至少保证10秒以上，否则容易被封

ERR_NO = 0  # 正常
ERR_REFUSE = 1  # 爬虫爬取速度过快，被拒绝
ERR_EX = 2  # 未知错误


def getHtml(url, ref=None, reget=5):
    try:
        request = urllib2.Request(url)
        request.add_header('User-Agent',
                           'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36')
        if ref:
            request.add_header('Referer', ref)
        page = urllib2.urlopen(request, timeout=10)
        html = page.read()
    except:
        if reget >= 1:
            # 如果getHtml失败，则再次尝试5次
            print 'getHtml error,reget...%d' % (6 - reget)
            time.sleep(2)
            return getHtml(url, ref, reget - 1)
        else:
            print 'request url:' + url
            print 'failed to fetch html'
            exit()
    else:
        return html

class Db(object):
    def __init__(self):
        self.dbconn = None
        self.dbcurr = None

    def check_conn(self):
        try:
            self.dbconn.ping()
        except:
            return False
        else:
            return True

    def conn(self):
        self.dbconn = mdb.connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, charset='utf8')
        self.dbconn.autocommit(False)
        self.dbcurr = self.dbconn.cursor()

    def fetchone(self):
        return self.dbcurr.fetchone()

    def fetchall(self):
        return self.dbcurr.fetchall()

    def execute(self, sql, args=None, falg=False):
        if not self.dbconn:
            # 第一次链接数据库
            self.conn()
        try:
            if args:
                rs = self.dbcurr.execute(sql, args)
            else:
                rs = self.dbcurr.execute(sql)
            return rs
        except Exception, e:
            if self.check_conn():
                print 'execute error'
                traceback.print_exc()
            else:
                print 'reconnect mysql'
                self.conn()
                if args:
                    rs = self.dbcurr.execute(sql, args)
                else:
                    rs = self.dbcurr.execute(sql)
                return rs

    def commit(self):
        self.dbconn.commit()

    def rollback(self):
        self.dbconn.rollback()

    def close(self):
        self.dbconn.close()
        self.dbcurr.close()

    def last_row_id(self):
        return self.dbcurr.lastrowid


class BaiduPanCheck(object):
    def __init__(self):
        self.db = Db()
        self.queue = Queue.Queue(maxsize = 1000)
        self.tmpFid = 0

    def getPage(self,uk,shareid):
        url = 'http://pan.baidu.com/share/link?shareid=%s&uk=%d' % (shareid,uk)
        return getHtml(url, uk)

    def startCheck(self):
        if self.queue.empty():
            sql = 'SELECT * from share_file ORDER BY fid DESC limit %d,1000' % self.tmpFid
            datas = self.db.execute(sql)
            if datas <= 0:
                print '取出数据错误或者已检测完成'
                return False
            fetchall = self.db.fetchall()
            for item in fetchall:
                self.queue.put({
                    'uid':item[13],
                    'uk':item[2],
                    'shareid':item[7],
                })
                self.tmpFid = item[0]

        while not self.queue.empty():
            data = self.queue.get()
            rs = self.getPage(data['uk'], data['shareid'])
            rule = ur'<title>.*</title>'
            titles = re.findall(rule, rs)
            if titles == []:
                title = ''
            else:
                title = titles[0][7:-8]
            if title == '百度网盘-链接不存在':
                print '====='+data['shareid']+'====='
                self.db.execute("UPDATE share_file set deleted=%d WHERE sid=%d", (1, data['uid']))
                self.db.commit()
            else:
                print data['shareid']
        return true


if __name__ == "__main__":
    spider = BaiduPanCheck()
    while (1):
        spider.startCheck()
