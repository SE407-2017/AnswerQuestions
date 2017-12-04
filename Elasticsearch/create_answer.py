# -- coding: utf-8 --
#生成新回答，可生成多个回答
from datetime import datetime
from elasticsearch import Elasticsearch
import sys

def create_answer(answer, id_num):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    res = es.get(index = "question_index", doc_type = "question", id = id_num)
    answer_body = {
        "content": res['content'],
        "response": res['response'].append(answer),
        "timestamp": datetime.now()
    }
    es.index(index = "question_index", doc_type = "question", id = id_num, body = answer_body)

create_answer(answer = sys.argv[1], id_num = sys.argv[2])
