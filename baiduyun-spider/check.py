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
        result = self.db.execute('SELECT * from check_id')
        resultOne = self.db.fetchone()
        self.tmpFid = resultOne[1]

    def getPage(self,uk,shareid):
        url = 'http://pan.baidu.com/share/link?shareid=%s&uk=%s' % (shareid,uk)
        return getHtml(url, uk)

    def startCheck(self):
        if self.queue.empty():
            sql = 'SELECT * from share_file ORDER BY fid ASC limit %s,1000' % self.tmpFid
            datas = self.db.execute(sql)
            if datas <= 0:
                print '取出数据错误或者已检测完成'
                return False
            fetchall = self.db.fetchall()
            for item in fetchall:
                self.queue.put({
                    'fid':item[0],
                    'uid':item[13],
                    'uk':item[2],
                    'shareid':item[7]
                })
                self.tmpFid = item[0]
            self.db.execute("UPDATE check_id set temp_id=%s WHERE id=%s", (self.tmpFid,1))
            self.db.commit()

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
                self.db.execute("UPDATE share_file set deleted=%s WHERE sid=%s", (1, data['uid']))
                self.db.commit()
            else:
                print data['shareid']
                self.tmpFid = data['fid']
                self.db.execute("UPDATE check_id set temp_id=%s WHERE id=%s", (self.tmpFid,1))
                self.db.commit()
        return true


if __name__ == "__main__":
    spider = BaiduPanCheck()
    while (1):
        checkResult = spider.startCheck()
        if checkResult:
            print '一个队列完成'
