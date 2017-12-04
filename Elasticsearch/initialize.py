# -- coding: utf-8 --
#初始化Elasticsearch索引，设置映射
from datetime import datetime
from elasticsearch import Elasticsearch

es = Elasticsearch([{'host':'localhost','port':9200}])
index_mappings = {
    "mappings": {
        "question": { 
            "properties": { 
                "content": {
                    "type": "text",
                    "analyzer": "ik_max_word",
                    "search_analyzer": "ik_max_word"
                    }, 
                "response": {
                    "type": "text",
                    "analyzer": "ik_max_word",
                    "search_analyzer": "ik_max_word"
                    }, 
                "reply_num": {"type": "integer"},
                "response_state": {"type": "text"}
                }
            }
        }
    }
if es.indices.exists(index = "question_index") is not True:
    es.indices.create(index = "question_index", body = index_mappings)
