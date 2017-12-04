# -- coding: utf-8 --
#查询模块，针对中文进行了优化配置
from elasticsearch import Elasticsearch
import sys

def search(keyword):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    query_question = {
        "query": {
            "multi_match": {
                "query": keyword,
                "type": "best_fields",
                "fields": ["content^2", "response"],
                "tie_breaker": 0.3,
                "minimum_should_match": "50%"
                }
            },
        "highlight": {
            "fields" : {
                "content" : {},
                "response" : {}
                }
            }
        }
    res = es.search(index = "question_index", doc_type = "question", body = query_question)
    return res

search(keyword = sys.argv[1])
