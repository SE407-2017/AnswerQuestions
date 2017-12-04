# -- coding: utf-8 --
#生成新问题
from datetime import datetime
from elasticsearch import Elasticsearch
import sys

def create_question(question, id_num):
    es = Elasticsearch([{'host':'localhost','port':9200}])
    question_body = {
        "content": question,
        "response": [],
        "timestamp": datetime.now()
    }
    es.index(index = "question_index", doc_type = "question", id = id_num, body = question_body)

create_question(question = sys.argv[1], id_num = sys.argv[2])
