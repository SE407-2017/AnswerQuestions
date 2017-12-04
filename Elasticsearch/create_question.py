# -- coding: utf-8 --
#生成新问题
from elasticsearch import Elasticsearch
import sys

def create_question(id_num, question):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    question_body = {
        "content": question,
        "response": [],
        "reply_num": 0,
        "response_state": "未解决“
    }
    es.index(index = "question_index", doc_type = "question", id = id_num, body = question_body)

create_question(id_num = sys.argv[1], question = sys.argv[2])
