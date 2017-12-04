# -- coding: utf-8 --
#改变已有问题
from datetime import datetime
from elasticsearch import Elasticsearch
import sys

def change_question(new_question, id_num):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    res = es.get(index = "question_index", doc_type = "question", id = id_num)
    question_body = {
        "content": new_question,
        "response": res['response'],
        "timestamp": datetime.now()
    }
    es.index(index = "question_index", doc_type = "question", id = id_num, body = question_body)

change_question(new_question = sys.argv[1], id_num = sys.argv[2])
