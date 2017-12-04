# 简介
	基于Elasticsearch搜索引擎的搜索模块
## 运行环境
	·Elasticsearch：Windows系统下; Java JDK 8及以上;
	·Python：Python 2.7; 并装载有elasticsearch-py api;
### 运行及接口
	·启动Elasticsearch：运行 $/elasticsearch-6.0.0/bin/elasticsearch.bat,无需配置参数;
	·初始化索引：运行initialize.py;
	·生成问题：调用create_question.py,需要两个参数：问题内容和程序生成的标识序列;
	·修改问题：调用change_question.py,需要两个参数：新问题内容和原问题的标识序列;
	·添加回答：调用create_answer.py,需要两个参数：回答内容和原问题的标识序列;
	·搜索问题：调用search.py,需要一个参数：搜索的关键字;返回查询到的json格式文档,格式实例如下：
	{
		u'hits': {
			u'hits': [{
				u'_type': u'question', 
				u'_source': {
					u'content': u'\u5728\u5982\u56fe\u6240\u793a\u56fe\u5f62\u4e2d,f(x)', 
					u'timestamp': u'2017-12-04T17:13:50.909000', 
					u'response': [u'Elasticsearch \u592a\u5e05\u5566', u'\u8fd8\u6709']
				}, 
				u'_score': 0.5753642, 
				u'_index': u'question_index', 
				u'highlight': {
					u'content': [u'\u5728<em>\u5982\u56fe</em>\u6240\u793a\u56fe\u5f62\u4e2d,f(x)']
				}, 
				u'_id': u'1'
			}], 
			u'total': 1, 
			u'max_score': 0.5753642
		}, 
		u'_shards': {
			u'successful': 5, 
			u'failed': 0, 
			u'skipped': 0, 
			u'total': 5
		}, 
		u'took': 65, 
		u'timed_out': False
	}
